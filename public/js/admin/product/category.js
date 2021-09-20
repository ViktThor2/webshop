$(function () {

    $('#new_button_main').on('click', function(){
        $('#MainModal').modal('show');
    });

    $('#new_button_sub').on('click', function(){
        $('#SubModal').modal('show');
    });

    $('.modelClose').on('click', function(){
        $('.modal').modal('hide');
        $('.modal').hide();
    });

    function response(data){
        if ((data.errors)) {
            toastr.error(data.errors, 'Hiba', {timeOut: 3000});
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
            toastr.success( data.success, 'Siker', {timeOut: 3000});
        }
    }

    function error(err){
        if (err.status == 403) { 
            console.log(err.responseJSON);
            toastr.error(err.responseJSON.message, 'Hiba', {timeOut: 3000});
        }
    }

    // init datatable.
    $('.datatable').DataTable({
        dom:"<'row'<'col-md-2'l><'col-md-7'B><'col-md-3'f>>" +
        "<'row'<'d-flex d-md-none justify-content-between mt-2 mb-2'lf>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'d-none d-md-flex justify-content-between mt-2 mb-2'ip>>" +
        "<'row'<'d-flex d-md-none justify-content-between mt-2 mb-2'ip>>",
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 találat', '25 találat', '50 találat', 'Összes találat' ]
        ],
        buttons: [
            { extend: 'excel', className: 'btn-primary' },
            { extend: 'csv', className: 'btn-primary' },
            { extend: 'pdf', className: 'btn-primary' },
            { extend: 'print', className: 'btn-primary' },
        ],
        processing: true,
        serverSide: true,
        autoWidth: false,
        pageLength: 10,
        "order": [[ 0, "asc" ]],
        ajax: { url: "http://127.0.0.1:8000/category" },
        columns: [
            {data: 'main', name: 'main'},
            {data: 'sub', name: 'sub'},
            { data: 'Actions', name: 'Actions',
                orderable:false, serachable:false },
        ],
    });


    // Create article Ajax request.
    $('#SubmitCreateMain').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            url: "http://127.0.0.1:8000/category",
            method: 'post',
            data: { name: $('#mainCatName').val() },
            success: function(data) { response(data) },
            error: function (err) { error(err) }
        });
    });


    // Create article Ajax request.
    $('#SubmitCreateSub').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            url: "http://127.0.0.1:8000/category",
            method: 'post',
            data: {
                name: $('#name').val(),
                main_category_id: $('#main_category_id').val(),
            },
            success: function(data) { response(data) },
            error: function (err) { error(err) }
        });
    });


    // Get single article in EditModel
    var id;
    $('body').on('click', '#getEditMain', function(e) {
        e.preventDefault();
        id = $(this).data('id');
        $.ajax({
            url: "category/"+id+"/edit",
            method: 'GET',
            success: function(result) {
                console.log(result);
                $('#EditMainModalBody').html(result.html);
                $('#EditMainModal').show();
            }
        });
    });


    // Get single article in EditModel
    var id;
    $('body').on('click', '#getEditSub', function(e) {
        e.preventDefault();
        id = $(this).data('id');
        $.ajax({
            url: "subcategory/"+id+"/edit",
            method: 'GET',
            success: function(result) {
                console.log(result);
                $('#EditSubModalBody').html(result.html);
                $('#EditSubModal').show();
            }
        });
    });


    // Update  Ajax request.
    $('#SubmitEditMain').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            url: "category/"+id,
            method: 'PUT',
            data:{ name: $('#editMainName').val() },
            success: function(data) { response(data) },
            error: function (err) { error(err) }
        });
    });


    // Update  Ajax request.
    $('#SubmitEditSub').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            url: "category/"+id,
            method: 'PUT',
            data: {
                name: $('#editSubName').val(),
                main_category_id: $('#editMain_category_id').val(),
            },
            success: function(data) { response(data) },
            error: function (err) { error(err) }
        });
    });


    // Delete  request.
    var deleteID;
    $('body').on('click', '#getDeleteMain', function(){
        deleteID = $(this).data('id');
        $('#DeleteMainModal').modal('show');
    })

    $('#SubmitDeleteMain').click(function(e) {
        e.preventDefault();
        var id = deleteID;
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            url: "category/"+id,
            method: 'DELETE',
            success: function(data) { response(data) },
            error: function (err) { error(err) }
        });
    });


    // Delete  request.
    var deleteID;
    $('body').on('click', '#getDeleteSub', function(){
        deleteID = $(this).data('id');
        $('#DeleteSubModal').modal('show');
    })

    $('#SubmitDeleteSub').click(function(e) {
        e.preventDefault();
        var id = deleteID;
        $.ajaxSetup({
            headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            url: "subcategory/"+id,
            method: 'DELETE',
            success: function(data) { response(data) },
            error: function (err) { error(err) }
        });
    });

}); 