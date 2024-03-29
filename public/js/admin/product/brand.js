$(document).ready(function() {
    
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
    var table = $('.datatable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf'
        ],
        processing: true,
        serverSide: true,
        autoWidth: false,
        pageLength: 10,
        order: [[0, 'desc']],
        ajax: { url: "http://127.0.0.1:8000/brand" },
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
            url: "http://127.0.0.1:8000/brand",
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
            url: "brand/"+id+"/edit",
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
            url: "brand/"+id,
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
            url: "brand/"+id,
            method: 'DELETE',
            success: function(data) { response(data) },
            error: function (err) { error(err) }
        });
    });

}); 