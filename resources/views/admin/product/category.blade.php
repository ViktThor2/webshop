@extends('admin.layouts.admin')

@section('content')

{{-- Index --}}
<div class="col-12">
    <div class="card mt-2">
        <div class="card-header">
            <h3 class="card-title">Kategóriák</h3>
            <div class="card-tools">
                <button id="new_button_main" class="btn btn-success">
                    <i class="fas fa-plus fa-sm"></i>Új Főkategória
                </button>
                <button id="new_button_sub" class="btn btn-success">
                    <i class="fas fa-plus fa-sm"></i>Új Alkategória
                </button>       
            </div>
        </div>
        <div class="card-body">
            <table class="table table-condensed table-bordered table-hover datatable">
                <thead>
                    <tr>
                        <th width="50%" class="align-middle">Főkategória</th>
                        <th class="align-middle">Alkategória</th>
                        <th width="100px"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Create  Modal -->
<div class="modal" id="MainModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Főkategória létrehozása</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="mainCatName"
                                id="mainCatName" placeholder="Név" required>
                    <label for="mainCatName">Név</label>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-danger modelClose">Bezár</button>
                <button class="btn btn-success" id="SubmitCreateMain">Mentés</button>
            </div>
        </div>
    </div>
</div>

<!-- Create  Modal -->
<div class="modal" id="SubModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Alkategória létrehozása</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-floating mb-2">
                    <select class="form-control select2" name="main_category_id"
                                id="main_category_id" required>
                        <option selected disabled>Kérem válasszon főkategóriát</option>
                        @foreach($mainCategories as $mainCategory)
                            <option value="{{ $mainCategory->id }}">
                                {{ $mainCategory->name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="main_category_id">Főkategória</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="name" id="name"
                                placeholder="Név" required>
                    <label for="name">Név</label>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-danger modelClose">Bezár</button>
                <button class="btn btn-success" id="SubmitCreateSub">Mentés</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit  Modal -->
<div class="modal" id="EditMainModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Főkategória szerkesztése</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body" id="EditMainModalBody">
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-danger modelClose">Bezár</button>
                <button class="btn btn-success" id="SubmitEditMain">Mentés</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit  Modal -->
<div class="modal" id="EditSubModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Alkategória szerkesztése</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body" id="EditSubModalBody">
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-danger modelClose">Bezár</button>
                <button class="btn btn-success" id="SubmitEditSub">Mentés</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete  Modal -->
<div class="modal" id="DeleteMainModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Főkategória törlése</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h4>Biztos, hogy törölni szeretnéd a kategóriát?</h4>
                <h5>( Az alkategóriák is törlődni fognak )</h5>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-danger modelClose">Nem</button>
                <button class="btn btn-success" id="SubmitDeleteMain">
                    Igen
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete  Modal -->
<div class="modal" id="DeleteSubModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Alkategória törlése</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h4>Biztos, hogy törölni szeretnéd a kategóriát?</h4>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-danger modelClose">Nem</button>
                <button class="btn btn-success" id="SubmitDeleteSub">
                    Igen
                </button>
            </div>
        </div>
    </div>
</div>

@endsection    

@section('script')
    <script type="text/javascript"
        src="{{ asset('js/admin/product/category.js') }}">
    </script>
@endsection