$(document).ready(function()
{

    // init datatable.
    var table = $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        pageLength: 10,
        "order": [[ 0, "desc" ]],
        ajax: {
            url: "http://127.0.0.1:8000/brand"
        },
        columns: [
            {data: 'name', name: 'name'},
            {
                data: 'Actions', name: 'Actions',
                orderable:false, serachable:false,sClass:'text-center'
            },
        ],
    });

    $('#new_button').click(function() {
        $('#BrandModal').modal('show');
    })

    $('#CloseModal').click(function() {
        $('#BrandModal').modal('hide');
    })

    // Create article Ajax request.
    $('#SubmitCreateBrandForm').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "http://127.0.0.1:8000/brand",
            method: 'post',
            data: {
                name: $('#name').val(),
            },
            success: function(result) {
                    $('.alert-danger').hide();
                    $('.alert-success').show();
                    $('.datatable').DataTable().ajax.reload();
                    setTimeout( function() {
                        $('.alert-success').hide();
                        $('#BrandModal').modal('hide');
                        $(".modal-body input").val("")
                    }, 1000);
            },  
            error: function (err) {
                if (err.status == 422) { // when status code is 422, it's a validation issue
                    console.log(err.responseJSON);
                    $('#success_message').fadeIn().html(err.responseJSON.message);
                    // you can loop through the errors object and show it to the user
                    console.warn(err.responseJSON.errors);
                    // display errors on each form field
                    $.each(err.responseJSON.errors, function (i, error) {
                        var el = $(document).find('[name="'+i+'"]');
                        el.after($('<span style="color: red;">'+error[0]+'</span>'));
                    });
                }
            }
        });
    });

    // Get single article in EditModel
    $('.modelClose').on('click', function(){
        $('#EditBrandModal').hide();
    });
    var id;
    $('body').on('click', '#getEditBrandData', function(e) {
         e.preventDefault();
        $('.alert-danger').html('');
        $('.alert-danger').hide();
            id = $(this).data('id');
        $.ajax({
            url: "brand/"+id+"/edit",
            method: 'GET',
            success: function(result) {
                console.log(result);
                $('#EditBrandModalBody').html(result.html);
                $('#EditBrandModal').show();
            }
        });
    });

    // Update  Ajax request.
    $('#SubmitEditBrandForm').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "brand/"+id,
            method: 'PUT',
            data: {
                name: $('#editName').val(),
            },
            success: function(result) {
                    $('.alert-danger').hide();
                    $('.alert-success').show();
                    $('.datatable').DataTable().ajax.reload();
                    setTimeout( function() {
                        $('.alert-success').hide();
                        $('#EditBrandModal').hide();
                        $(".modal-body input").val("")
                    }, 2000);
            },  
            error: function (err) {
                if (err.status == 422) { // when status code is 422, it's a validation issue
                    console.log(err.responseJSON);
                    $('#success_message').fadeIn().html(err.responseJSON.message);
                    // you can loop through the errors object and show it to the user
                    console.warn(err.responseJSON.errors);
                    // display errors on each form field
                    $.each(err.responseJSON.errors, function (i, error) {
                        var el = $(document).find('[name="'+i+'"]');
                        el.after($('<span style="color: red;">'+error[0]+'</span>'));
                    });
                }
            }
        });
    });

    // Delete  request.
    var deleteID;
    $('body').on('click', '#getDeleteId', function(){
        deleteID = $(this).data('id');
    })
    $('#SubmitDeleteBrandForm').click(function(e) {
        e.preventDefault();
        var id = deleteID;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "brand/"+id,
            method: 'DELETE',
            success: function(result) {
                    $('.alert-danger').hide();
                    $('.alert-success').show();
                    $('.datatable').DataTable().ajax.reload();
                    setTimeout( function() {
                        $('.alert-success').hide();
                        $('#DeleteBrandModal').hide();
                        $('.modal-backdrop').remove();
                        console.log('teszt');
                    }, 2000);
            },  
        });
    });


});