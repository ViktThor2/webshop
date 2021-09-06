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
                    url: "http://127.0.0.1:8000/unit",
                },
                columns: [
                    {data: 'name', name: 'name'},
                    {
                        data: 'Actions', name: 'Actions',
                        orderable:false, serachable:false,sClass:'text-center'
                    },
                ],
            });

            // Create article Ajax request.
            $('#SubmitCreateUnitForm').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "http://127.0.0.1:8000/unit",
                    method: 'post',
                    data: {
                        name: $('#name').val(),
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
                                $('#CreateUnitModal').modal('hide');
                                location.reload();
                            }, 2000);
                        }
                    }
                });
            });

            // Get single article in EditModel
            $('.modelClose').on('click', function(){
                $('#EditUnitModal').hide();
            });
            var id;
            $('body').on('click', '#getEditUnitData', function(e) {
                // e.preventDefault();
                $('.alert-danger').html('');
                $('.alert-danger').hide();
                    id = $(this).data('id');
                $.ajax({
                    url: "unit/"+id+"/edit",
                    method: 'GET',
                    success: function(result) {
                        console.log(result);
                        $('#EditUnitModalBody').html(result.html);
                        $('#EditUnitModal').show();
                    }
                });
            });
        
            // Update  Ajax request.
            $('#SubmitEditUnitForm').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "unit/"+id,
                    method: 'PUT',
                    data: {
                        name: $('#editName').val(),
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
                                $('#EditUnitModal').hide();
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
            $('#SubmitDeleteUnitForm').click(function(e) {
                e.preventDefault();
                var id = deleteID;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "unit/"+id,
                    method: 'DELETE',
                    success: function(result) {
                        setInterval(function(){
                            location.reload();
                            $('#DeleteUnitModal').hide();
                        }, 1000);
                    }
                });
            });


        }); 