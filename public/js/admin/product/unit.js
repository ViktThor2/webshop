$(function () {
    
    $('.modelClose').on('click', function(){
        $('.modal').modal('hide');
        $('.modal').hide();
    });

    $('#new_button').click(function() {
        $('#CreateModal').modal('show');
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
        "order": [[ 0, "desc" ]],
        ajax: { url: "http://127.0.0.1:8000/unit" },
        columns: [
            {data: 'name', name: 'name'},
            { data: 'Actions', name: 'Actions',
                orderable:false, serachable:false },
        ],  
    });

    // Create article Ajax request.
    $('#SubmitCreateForm').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.ajax({
            url: "http://127.0.0.1:8000/unit",
            method: 'post',
            data: { name: $('#name').val() },
            success: function(data) { response(data) },
            error: function (err) { error(err) }
        });
    });

    // Get single article in EditModel
    var id;
    $('body').on('click', '#getEdit', function(e) {
        e.preventDefault();
        id = $(this).data('id');
        $.ajax({
            url: "unit/"+id+"/edit",
            method: 'GET',
            success: function(data) {
                $('#EditModalBody').html(data.html);
                $('#EditModal').show();
            }
        });
    });

    // Update  Ajax request.
    $('#SubmitEditForm').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.ajax({
            url: "unit/"+id,
            method: 'PUT',
            data: { name: $('#editName').val() },
            success: function(data) { response(data) },
            error: function (err) { error(err) }
        });
    });

    // Delete  request.
    var deleteID;
    $('body').on('click', '#getDelete', function(){
        $('#DeleteModal').modal('show');
        deleteID = $(this).data('id');
    })
    $('#SubmitDeleteForm').click(function(e) {
        e.preventDefault();
        var id = deleteID;
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.ajax({
            url: "unit/"+id,
            method: 'DELETE',
            success: function(data) { response(data) },
            error: function (err) { error(err) }
        });
    });

}); 