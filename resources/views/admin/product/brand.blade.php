@extends('admin.layouts.admin')

@section('content')

    {{-- Index --}}
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                Márkák
                <button id="new_button" class="btn btn-success" type="button">
                    <i class="fas fa-plus fa-sm"></i>Új
                </button>
            </div>
            <div class="card-body">

                <table class="table table-condensed table-bordered
                        table-hover datatable" id="brands-table">
                    <thead>
                        <tr>
                            <th class="align-middle">Név</th>
                            <th width="100px"></th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>


    <!-- Create  Modal -->
    <div class="modal" id="BrandModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Márka létrehozása</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body" id="BrandModalBody">
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                        <strong>Siker! </strong>Márka létrehozva.
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Név" required>
                        <label for="name">Név</label>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="CloseModal">Bezár</button>
                    <button type="button" class="btn btn-success" id="SubmitCreateBrandForm">Mentés</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit  Modal -->
    <div class="modal" id="EditBrandModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Márka szerkesztése</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body" id="EditBrandModalBody">
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                        <strong>Siker! </strong>Márka frissítve.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger modelClose" id="CloseEditModal">Bezár</button>
                    <button type="button" class="btn btn-success" id="SubmitEditBrandForm">Mentés</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Delete  Modal -->
    <div class="modal" id="DeleteBrandModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Márka törlése</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="suc" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                        <strong>Siker! </strong>Márka törölve.
                    </div>
                    <h4>Biztos, hogy törölni szeretnéd a márkát?</h4>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Nem</button>
                    <button type="button" class="btn btn-success" id="SubmitDeleteBrandForm">Igen</button>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')

    <script type="text/javascript">
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
                    url: '{{ route('brand.index') }}'
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
                    url: "{{ route('brand.store') }}",
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
    </script>
@endsection