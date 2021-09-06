$(document).ready(function() 
{
    // init datatable.
    $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        pageLength: 10,
        "order": [[ 0, "asc" ]],
        ajax: {
            url: "http://127.0.0.1:8000/category"
        },
        columns: [
            {data: 'main', name: 'main'},
            {data: 'sub', name: 'sub'},
            {
                data: 'Actions', name: 'Actions',
                orderable:false, serachable:false,sClass:'text-center'
            },
        ],
    });


    // Create article Ajax request.
    $('#SubmitCreateMainCategoryForm').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "http://127.0.0.1:8000/category",
            method: 'post',
            data: {
                name: $('#mainCatName').val(),
            },
            success: function(result) {
                if(result.errors) {
                    $('.alert-danger').html('');
                    $.each(result.errors, function(key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                    });
                } else {
                    $('.alert-danger').hide();
                    $('.alert-success').show();
                    $('.datatable').DataTable().ajax.reload();
                    setInterval(function(){
                        $('.alert-success').hide();
                        $('#CreateBrandModal').modal('hide');
                        location.reload();
                    }, 2000);
                }
            }
        });
    });


    // Create article Ajax request.
    $('#SubmitCreateCategoryForm').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('category.store') }}",
            method: 'post',
            data: {
                name: $('#name').val(),
                main_category_id: $('#main_category_id').val(),
            },
            success: function(result) {
                if(result.errors) {
                    $('.alert-danger').html('');
                    $.each(result.errors, function(key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                    });
                } else {
                    $('.alert-danger').hide();
                    $('.alert-success').show();
                    $('.datatable').DataTable().ajax.reload();
                    setInterval(function(){
                        $('.alert-success').hide();
                        $('#CreateBrandModal').modal('hide');
                        location.reload();
                    }, 2000);
                }
            }
        });
    });


    // Get single article in EditModel
    $('.modelClose').on('click', function(){
        $('#EditMainCategoryModal').hide();
    });
    var id;
    $('body').on('click', '#getEditMainCategoryData', function(e) {
        // e.preventDefault();
        $('.alert-danger').html('');
        $('.alert-danger').hide();
            id = $(this).data('id');
        $.ajax({
            url: "category/"+id+"/edit",
            method: 'GET',
            success: function(result) {
                console.log(result);
                $('#EditMainCategoryModalBody').html(result.html);
                $('#EditMainCategoryModal').show();
            }
        });
    });


    // Get single article in EditModel
    $('.modelClose').on('click', function(){
        $('#EditSubCategoryModal').hide();
    });
    var id;
    $('body').on('click', '#getEditSubCategoryData', function(e) {
        // e.preventDefault();
        $('.alert-danger').html('');
        $('.alert-danger').hide();
            id = $(this).data('id');
        $.ajax({
            url: "subcategory/"+id+"/edit",
            method: 'GET',
            success: function(result) {
                console.log(result);
                $('#EditSubCategoryModalBody').html(result.html);
                $('#EditSubCategoryModal').show();
            }
        });
    });


    // Update  Ajax request.
    $('#SubmitEditMainCategoryForm').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "category/"+id,
            method: 'PUT',
            data: {
                name: $('#editMainName').val(),
            },
            success: function(result) {
                if(result.errors) {
                    $('.alert-danger').html('');
                    $.each(result.errors, function(key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                    });
                } else {
                    $('.alert-danger').hide();
                    $('.alert-success').show();
                    location.reload();
                    setInterval(function(){
                        $('.alert-success').hide();
                        $('#EditMainCategoryModal').hide();
                    }, 2000);
                }
            }
        });
    });


    // Update  Ajax request.
    $('#SubmitEditSubCategoryForm').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "category/"+id,
            method: 'PUT',
            data: {
                name: $('#editSubName').val(),
                main_category_id: $('#editMain_category_id').val(),
            },
            success: function(result) {
                if(result.errors) {
                    $('.alert-danger').html('');
                    $.each(result.errors, function(key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                    });
                } else {
                    $('.alert-danger').hide();
                    $('.alert-success').show();
                    location.reload();
                    setInterval(function(){
                        $('.alert-success').hide();
                        $('#EditSubCategoryModal').hide();
                    }, 2000);
                }
            }
        });
    });


    // Delete  request.
    var deleteID;
    $('body').on('click', '#getDeleteMainId', function(){
        deleteID = $(this).data('id');
    })
    $('#SubmitDeleteMainCategoryForm').click(function(e) {
        e.preventDefault();
        var id = deleteID;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "category/"+id,
            method: 'DELETE',
            success: function(result) {
                setInterval(function(){
                    location.reload();
                    $('#DeleteMainCategoryModal').hide();
                }, 1000);
            }
        });
    });


    // Delete  request.
    var deleteID;
    $('body').on('click', '#getDeleteSubId', function(){
        deleteID = $(this).data('id');
    })
    $('#SubmitDeleteSubCategoryForm').click(function(e) {
        e.preventDefault();
        var id = deleteID;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "subcategory/"+id,
            method: 'DELETE',
            success: function(result) {
                setInterval(function(){
                    location.reload();
                    $('#DeleteSubCategoryModal').hide();
                }, 1000);
            }
        });
    });

}); 