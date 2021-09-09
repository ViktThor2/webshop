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
            toastr.error(data.errors, 'Hiba', {timeOut: 4000});
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
            $(".modal-body input").val("");
            $('.select2').prop('selectedIndex',0);
            $('#description').val("");
            toastr.success( data.success, 'Siker', {timeOut: 4000});
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

    var template = Handlebars.compile($("#details-template").html());
    
    // init datatable.
    const dataTable = $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        pageLength: 10,
        "order": [[ 0, "desc" ]],
        ajax: { url: "http://127.0.0.1:8000/product" },
        columns: [
            {
                "className":      'details-control',
                "orderable":      false,
                "searchable":     false,
                "data":           null,
                "defaultContent": ''
            },
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'main_category_id', name: 'main_category_id'},
            {data: 'sub_category_id', name: 'sub_category_id'},
            {data: 'brand_id', name: 'brand_id'},
            {data: 'brutto', name: 'brutto'},
            {data: 'qty', name: 'qty'},
            {data: 'Activate', name: 'Activate'},
            { data: 'Actions', name: 'Actions',
                orderable:false, serachable:false },  
        ],
    });

    // Add event listener for opening and closing details
    $('#product-table tbody').on('click', 'td.details-control', function () {
        const tr = $(this).closest('tr');
        const row = dataTable.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( template(row.data()) ).show();
            tr.addClass('shown');
        }
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
            },
            success: function(data) { response(data) }
        });
    });

    var id;
    // Get single article in EditModel
    $('body').on('click', '#getEdit', function(e) {
        e.preventDefault();
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
                main_category_id: $('#editMain_category_id').val(),
                sub_category_id: $('#editSub_category_id').val(),
                brand_id: $('#editBrand_id').val(),
                amount_unit_id: $('#editAmount_unit_id').val(),
                description: $('#editDescription').val(),
            },
            success: function(data) { response(data) }
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