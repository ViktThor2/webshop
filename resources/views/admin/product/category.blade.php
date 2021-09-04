@extends('admin.layouts.admin')

@section('content')

    {{-- Index --}}
    <div class="col-12">
        <div class="card mt-2">
            <div class="card-header">
                Kategóriák
                <button id="new_button" class="btn btn-success" type="button"  
                        data-toggle="modal" data-target="#MainCategoryModal">
                    <i class="fas fa-plus fa-sm"></i>Új Főkategória
                </button>
                <button id="new_button" class="btn btn-success" type="button" style="margin-right: 5px"
                        data-toggle="modal" data-target="#SubCategoryModal">
                    <i class="fas fa-plus fa-sm"></i>Új Alkategória
                </button>
            </div>
            <div class="card-body">

                <table class="table table-condensed table-bordered
                        table-hover datatable" id="brands-table">
                    <thead>
                        <tr>
                            <th class="align-middle">Alkategória</th>
                            <th width="50%" class="align-middle">Főkategória</th>
                            <th width="100px"></th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>

    <!-- Create  Modal -->
    <div class="modal" id="MainCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Főkategória létrehozása</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body" id="MainCategoryModalBody">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                        <strong>Siker! </strong>Kategória létrehozva.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="mainCatName" id="mainCatName" placeholder="Név" required>
                        <label for="mainCatName">Név</label>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Bezár</button>
                    <button type="button" class="btn btn-success" id="SubmitCreateMainCategoryForm">Mentés</button>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Create  Modal -->
    <div class="modal" id="SubCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Alkategória létrehozása</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body" id="SubCategoryModalBody">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                        <strong>Siker! </strong>Alkategória létrehozva.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="form-floating mb-2">
                        <select class="form-control select2" name="main_category_id" id="main_category_id" required>
                            <option selected>Kérem válasszon főkategóriát</option>
                            @foreach($mainCategories as $mainCategory)
                                <option value="{{ $mainCategory->id }}">{{ $mainCategory->name }}</option>
                            @endforeach
                        </select>
                        <label for="main_category_id">Főkategória</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Név" required>
                        <label for="name">Név</label>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Bezár</button>
                    <button type="button" class="btn btn-success" id="SubmitCreateCategoryForm">Mentés</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit  Modal -->
    <div class="modal" id="EditMainCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Főkategória szerkesztése</h4>
                    <button type="button" class="close modelClose" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body" id="EditMainCategoryModalBody">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                        <strong>Siker!</strong>Főkategória frissítve.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">Bezár</button>
                    <button type="button" class="btn btn-success" id="SubmitEditMainCategoryForm">Mentés</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit  Modal -->
    <div class="modal" id="EditSubCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Alkategória szerkesztése</h4>
                    <button type="button" class="close modelClose" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body" id="EditSubCategoryModalBody">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                        <strong>Siker!</strong>Alkategória frissítve.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">Bezár</button>
                    <button type="button" class="btn btn-success" id="SubmitEditSubCategoryForm">Mentés</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Delete  Modal -->
    <div class="modal" id="DeleteMainCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Főkategória törlése</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h4>Biztos, hogy törölni szeretnéd a kategóriát?</h4>
                    <h5>( Az alkategóriák is törlődni fognak )</h5>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Nem</button>
                    <button type="button" class="btn btn-success" id="SubmitDeleteMainCategoryForm">Igen</button>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Delete  Modal -->
    <div class="modal" id="DeleteSubCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Alkategória törlése</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h4>Biztos, hogy törölni szeretnéd a kategóriát?</h4>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Nem</button>
                    <button type="button" class="btn btn-success" id="SubmitDeleteSubCategoryForm">Igen</button>
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
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 10,
                "order": [[ 0, "asc" ]],
                ajax: {
                    url: '{{ route('category.index') }}'
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
                    url: "{{ route('category.store') }}",
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
    </script>
@endsection