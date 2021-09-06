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
    <script src="{{ asset('js/product/brand.js') }}" type="text/javascript"></script>
@endsection