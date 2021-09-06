@extends('admin.layouts.admin')

@section('content')

    {{-- Index --}}
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                Márkák
                <button id="new_button" class="btn btn-success" type="button"  
                        data-toggle="modal" data-target="#UnitModal">
                    <i class="fas fa-plus fa-sm"></i>Új
                </button>
            </div>
            <div class="card-body">

                <table class="table table-condensed table-bordered
                        table-hover datatable" id="units-table">
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
    <div class="modal" id="UnitModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Mennyiségi egység létrehozása</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body" id="UnitModalBody">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                        <strong>Siker! </strong>Mennyiségi egység létrehozva.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Név" required>
                        <label for="name">Név</label>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Bezár</button>
                    <button type="button" class="btn btn-success" id="SubmitCreateUnitForm">Mentés</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit  Modal -->
    <div class="modal" id="EditUnitModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Mennyiségi egység szerkesztése</h4>
                    <button type="button" class="close modelClose" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body" id="EditUnitModalBody">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                        <strong>Siker!</strong>Mennyiségi egység frissítve.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">Bezár</button>
                    <button type="button" class="btn btn-success" id="SubmitEditUnitForm">Mentés</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Delete  Modal -->
    <div class="modal" id="DeleteUnitModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Mennyiségi egység törlése</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h4>Biztos, hogy törölni szeretnéd a terméket?</h4>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Nem</button>
                    <button type="button" class="btn btn-success" id="SubmitDeleteUnitForm">Igen</button>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script src="{{ asset('js/product/unit.js') }}" type="text/javascript"></script>
@endsection