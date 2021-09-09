@extends('admin.layouts.admin')

@section('content')

{{-- Index --}}
<div class="col-md-12">
    <div class="card mt-2">
        <div class="card-header">Márkák
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
                <h4 class="modal-title">Márka létrehozása</h4>
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
                <h4 class="modal-title">Márka szerkesztése</h4>
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
                <h4 class="modal-title">Márka törlése</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h5>Biztos, hogy törölni szeretnéd a márkát?</h5>
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
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script type="text/javascript"
        src="{{ asset('js/admin/product/brand.js') }}">
    </script>
@endsection