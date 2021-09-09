$(document).ready(function() {

    $('#main_category_id').change(function(e) {
        e.preventDefault();
        var dependent = $(this).data('dependent');
        var id = $(this).val();
        $.ajaxSetup({
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            url: "http://127.0.0.1:8000/product/fetch/"+id,
            method:"GET",
            success:function(data){
                $('#'+dependent).html(data);
            }
        });
    });

    $('.modelClose').on('click', function(){
        $('.modal').modal('hide');
        $('.modal').hide();
    });

    $('#new_button').click(function() {
        $('#CreateModal').modal('show');
    });

    function response(data){
        if ((data.errors)) {
            toastr.error(data.errors, 'Hiba', {timeOut: 5000});
            $.each(data.errors, function (i, error) {
                var el = $(document).find('[name="'+i+'"]');
                el.after($('<span id="errorSpan" style="color: red;">'+error[0]+'</span>'));
                setTimeout( function() {
                    $('#errorSpan').hide();
                }, 2000);
            });
        } else {
            $('.datatable').DataTable().ajax.reload();
            $('.modal').modal('hide');
            $('.modal').hide();
            $(".modal-body input").val("")
            toastr.success( data.success, 'Siker', {timeOut: 5000});
        }
    }

    $('body').on('click', '#getActive', function() {
        id = $(this).data('id');
        $.ajax({
            url: "product/active/"+id,
            method: 'GET',
            success: function(data) {
                $('.datatable').DataTable().ajax.reload();
                toastr.success( data.success, 'Siker', {timeOut: 4000});
            },
        });
    });
    
    // init datatable.
    $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        pageLength: 10,
        "order": [[ 0, "desc" ]],
        ajax: { url: "http://127.0.0.1:8000/product" },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'main_category_id', name: 'main_category_id'},
            {data: 'sub_category_id', name: 'sub_category_id'},
            {data: 'brand_id', name: 'brand_id'},
            {data: 'netto', name: 'netto'},
            {data: 'vat_sum', name: 'vat_sum'},
            {data: 'brutto', name: 'brutto'},
            {data: 'qty', name: 'qty'},
            {data: 'Activate', name: 'Activate'},
            { data: 'Actions', name: 'Actions',
                orderable:false, serachable:false },  
        ],
    });

    // Create article Ajax request.
    $('#SubmitCreate').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            url: "http://127.0.0.1:8000/product",
            method: 'post',
            data: {
                name: $('#name').val(),
                netto: $('#netto').val(),
                vat_sum: $('#vat_sum').val(),
                vat_id: $('#vat_id').val(),
                brutto: $('#brutto').val(),
                main_category_id: $('#main_category_id').val(),
                sub_category_id: $('#sub_category_id').val(),
                brand_id: $('#brand_id').val(),
                amount_unit_id: $('#amount_unit_id').val(),
                description: $('#description').val(),
                qty: 0,
                active: 1
            },
            success: function(data) { response(data) }
        });
    });

    // Get single article in EditModel
    var id;
    $('body').on('click', '#getEdit', function(e) {
        e.preventDefault();
        $('.alert-danger').html('');
        $('.alert-danger').hide();
            id = $(this).data('id');
        $.ajax({
            url: "product/"+id+"/edit",
            method: 'GET',
            success: function(result) {
                $('#EditModalBody').html(result.html);
                $('#EditModal').show();
            }
        });
    });

    $('#editMain_category_id').change(function(e) {
        e.preventDefault();
        var dependent = $(this).data('dependent');
        var id = $(this).val();
        $.ajaxSetup({
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            url: "http://127.0.0.1:8000/product/fetch/"+id,
            method:"GET",
            success:function(data){
                $('#'+dependent).html(data);
            }
        });
    });

    // Update  Ajax request.
    $('#SubmitEdit').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            url: "product/"+id,
            method: 'PUT',
            data: {
                name: $('#editName').val(),
                netto: $('#editNetto').val(),
                vat_sum: $('#editVat_sum').val(),
                vat_id: $('#editVat_id').val(),
                brutto: $('#editBrutto').val(),
                main_category_id: $('#editSub_category_id').val(),
                sub_category_id: $('#editSub_category_id').val(),
                brand_id: $('#editBrand_id').val(),
                amount_unit_id: $('#editAmount_unit_id').val(),
                description: $('#editDescription').val(),
            },
           /* success: function(data) { response(data) }*/
        });
    });


    // Delete  request.
    var deleteID;
    $('body').on('click', '#getDelete', function(){
        $('#DeleteModal').modal('show');
        deleteID = $(this).data('id');
    })
    $('#SubmitDelete').click(function(e) {
        e.preventDefault();
        var id = deleteID;
        $.ajaxSetup({
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            url: "product/"+id,
            method: 'DELETE',
            success: function(data) { response(data) }
        });
    });

}); 