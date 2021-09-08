$(document).ready(function() 
{
    // init datatable.
    $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        pageLength: 10,
        "order": [[ 0, "desc" ]],
        ajax: {
            url: "http://127.0.0.1:8000/product",
        },
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
            {
                data: 'Actions', name: 'Actions',
                orderable:false, serachable:false,sClass:'text-center'
            },  
        ],
    });

    // Create article Ajax request.
    $('#SubmitCreateProductForm').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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
                qty: 0  ,
                sub_category_id: $('#sub_category_id').val(),
                brand_id: $('#brand_id').val(),
                amount_unit_id: $('#amount_unit_id').val(),
                description: $('#description').val(),
                active: 1,
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
                        $('#CreateProductModal').modal('hide');
                        location.reload();
                    }, 2000);
                }
            }
        });
    });

    // Get single article in EditModel
    $('.modelClose').on('click', function(){
        $('#EditProductModal').hide();
    });
    var id;
    $('body').on('click', '#getEditProductData', function(e) {
        // e.preventDefault();
        $('.alert-danger').html('');
        $('.alert-danger').hide();
            id = $(this).data('id');
        $.ajax({
            url: "product/"+id+"/edit",
            method: 'GET',
            success: function(result) {
                console.log(result);
                $('#EditProductModalBody').html(result.html);
                $('#EditProductModal').show();
            }
        });
    });

    // Update  Ajax request.
    $('#SubmitEditProductForm').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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
                sub_category_id: $('#editSub_category_id').val(),
                brand_id: $('#editBrand_id').val(),
                amount_unit_id: $('#editAmount_unit_id').val(),
                description: $('#editDescription').val(),
                qty: 0  ,
                active: 1,
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
                        $('#EditProductModal').hide();
                    }, 2000);
                }
            }
        });
    });


    // Delete  request.
    var deleteID;
    $('body').on('click', '#getDeleteId', function(){
        deleteID = $(this).data('id');
    })
    $('#SubmitDeleteProductForm').click(function(e) {
        e.preventDefault();
        var id = deleteID;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "product/"+id,
            method: 'DELETE',
            success: function(result) {
                setInterval(function(){
                    location.reload();
                    $('#DeleteProductModal').hide();
                }, 1000);
            }
        });
    });

}); 