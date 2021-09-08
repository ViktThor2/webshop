@extends('admin.layouts.admin')

@section('content')

{{-- Index --}}
<div class="col-md-12">
    <div class="card mt-2">
        <div class="card-header">
            Márkák
            <button id="new_button" class="btn btn-success">
                <i class="fas fa-plus fa-sm"></i>Új
            </button>
        </div>
        <div class="card-body">
            <table class="table table-condensed table-bordered table-hover datatable">
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
<div class="modal" id="CreateModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Mennyiségi egység létrehozása</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body" id="ModalBody">
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" 
                            name="name" id="name" placeholder="Név" required>
                    <label for="name">Név</label>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-danger modelClose">Bezár</button>
                <button class="btn btn-success" id="SubmitCreateForm">Mentés</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit  Modal -->
<div class="modal" id="EditModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Mennyiségi egység szerkesztése</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body" id="EditModalBody">
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-danger modelClose" id="closeEdit">Bezár</button>
                <button class="btn btn-success" id="SubmitEditForm">Mentés</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete  Modal -->
<div class="modal" id="DeleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Mennyiségi egység törlése</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h5>Biztos, hogy törölni szeretnéd a mennyiségi egységet?</h5>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-danger modelClose">Nem</button>
                <button class="btn btn-success" id="SubmitDeleteForm">Igen</button>
            </div>
        </div>
    </div>
</div>
    
@endsection

@section('script')
    <script type="text/javascript"
        src="{{ asset('js/admin/product/unit.js') }}">
    </script>
@endsection