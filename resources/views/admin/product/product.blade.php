@extends('admin.layouts.admin')

@section('content')

<script type="text/javascript"
    src="{{ asset('js/admin/product/sum.js') }}">
</script>

{{-- Index --}}
<div class="col-md-12">
    <div class="card mt-2">
        <div class="card-header">Termékek
            <button id="new_button" class="btn btn-success">
                <i class="fas fa-plus fa-sm"></i>Új
            </button>
        </div>
        <div class="card-body">
            <table class="table table-condensed table-bordered
                     table-hover datatable" id="product-table">
                <thead>
                    <tr>
                        <th class="align-middle"></th>
                        <th class="align-middle">Id</th>
                        <th class="align-middle">Név</th>
                        <th class="align-middle">Főkategória</th>
                        <th class="align-middle">Alkategória</th>
                        <th class="align-middle">Márka</th>
                        <th class="align-middle">Ár</th>
                        <th class="align-middle">Mennyiség</th>
                        <th class="align-middle">Aktív</th>
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
                <h4 class="modal-title">Termék létrehozása</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                {{--Form --}}
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="name" 
                                id="name" placeholder="Név" required>
                    <label for="name">Név</label>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-2">
                            <select class="form-control select2" name="vat_id" id="vat_id" required>
                                <option selected disabled>Válasszon ÁFÁ-t</option>
                                @foreach($vats as $vat)
                                    <option value="{{ $vat->name }}">
                                        {{ $vat->name }} %
                                    </option>
                                @endforeach
                            </select>
                            <label for="vat_id">Áfa</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-2">
                            <input type="number" class="form-control" name="vat_sum" 
                                            id="vat_sum" placeholder="Áfa" disabled>
                            <label for="vat_sum">Áfa</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-2">
                            <input type="number" class="form-control" name="netto" id="netto" 
                                        placeholder="Nettó" onkeyup="bruttoCalc()" required>
                            <label for="netto">Nettó</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-2">
                            <input type="number" class="form-control" name="brutto" id="brutto" 
                                        placeholder="Bruttó" onkeyup="nettoCalc()" required>
                            <label for="brutto">Bruttó</label>
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-2">
                    <select class="form-control select2" data-dependent="sub_category_id"
                             name="main_category_id" id="main_category_id" required>
                        <option selected disabled>Kérem válasszon főkategóriát</option>
                        @foreach($mainCategories as $mainCategory)
                            <option value="{{ $mainCategory->id }}">{{ $mainCategory->name }}</option>
                        @endforeach
                    </select>
                    <label for="main_category_id">Főkategória</label>
                </div>
                <div class="form-floating mb-2">
                    <select class="form-control select2" name="sub_category_id" id="sub_category_id" required>
                        <option selected disabled>Kérem válasszon alkategóriát</option>
                    </select>
                    <label for="sub_category_id">Alkategória</label>
                </div>
                <div class="form-floating mb-2">
                    <select class="form-control select2" name="brand_id" id="brand_id" required>
                        <option selected disabled>Kérem válasszon márkát</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    <label for="brand_id">Márka</label>
                </div>
                <div class="form-floating mb-2">
                    <select class="form-control select2" name="amount_unit_id"
                                id="amount_unit_id" required>
                        <option selected disabled>Kérem válasszon mennyiségi egységet</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                    </select>
                    <label for="amount_unit_id">Mennyiségi egység</label>
                </div>
                <div class="form-floating mb-2">
                    <textarea class="form-control" name="description" id="description" 
                        placeholder="Leírás ..." style="height: 150px"></textarea>
                    <label for="description">Leírás...</label>
                </div>
            {{--Form end --}}
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-danger modelClose">Bezár</button>
                <button class="btn btn-success" id="SubmitCreate">Mentés</button>
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
                <h4 class="modal-title">Termék szerkesztése</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body" id="EditModalBody">
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-danger modelClose">Bezár</button>
                <button class="btn btn-success" id="SubmitEdit">Mentés</button>
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
                <h4 class="modal-title">Termék törlése</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h4>Biztos, hogy törölni szeretnéd a terméket?</h4>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-danger modelClose">Nem</button>
                <button class="btn btn-success" id="SubmitDelete">Igen</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

    <script id="details-template" type="text/x-handlebars-template">
        <table class="table">
            <tr>
                <td width="25%">Név:</td>
                <td>@{{ name }}</td>
            </tr>
            <tr>
                <td>Nettó:</td>
                <td>@{{ netto }}</td>
            </tr>
            <tr>
                <td>Áfa:</td>
                <td>@{{ vat_sum }}</td>
            </tr>
            <tr>
                <td>Bruttó:</td>
                <td>@{{ brutto }}</td>
            </tr>
            <tr>
                <td>Márka:</td>
                <td>@{{ brand_id }}</td>
            </tr>
            <tr>
                <td>Kategória:</td>
                <td>@{{ main_category_id }} / @{{ sub_category_id }}</td>
            </tr>
            <tr>
                <td>Mennyiség:</td>
                <td>@{{ qty }}</td>
            </tr>
            <tr>
                <td>Leírás:</td>
                <td>@{{ description }}</td>
            </tr>
        </table>
    </script>

    <script type="text/javascript"
        src="{{ asset('js/admin/product/product.js') }}">
    </script>
@endsection