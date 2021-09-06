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

    <script src="{{ asset('js/brand.js') }}" type="text/javascript"></script>
@endsection