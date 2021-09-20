@extends('admin.layouts.admin')

@section('content')

<script type="text/javascript"
    src="{{ asset('js/admin/product/sum.js') }}">
</script>

{{-- Index --}}
<div class="col-md-12">

    {{-- Kereső --}}
    @include('admin.product.product-filter')

    {{-- Táblázat --}}  
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Termékek</h3>
            <div class="card-tools">
                <button id="new_button" class="btn btn-success">
                    <i class="fas fa-plus fa-sm"></i>Új
                </button>            
            </div>
        </div>
        <div class="card-body">
            <table class="table table-condensed table-bordered
                     table-hover datatable" id="product-table">
                <thead>
                    <tr>
                        <th width="2%" class="align-middle"></th>
                        <th width="2%" class="align-middle">Id</th>
                        <th class="align-middle">Név</th>
                        <th width="15%" class="align-middle">Főkategória</th>
                        <th width="10%" class="align-middle">Alkategória</th>
                        <th width="10%" class="align-middle">Márka</th>
                        <th width="10%" class="align-middle">Ár</th>
                        <th width="8%" class="align-middle">Mennyiség</th>
                        <th width="5%"  class="align-middle">Aktív</th>
                        <th width="150px"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
    
<!-- Create  Modal -->
<div class="modal fade bd-example-modal-lg" id="CreateModal">
    <div class="modal-dialog modal-lg">
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
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-2">
                            <select class="form-control select2" data-dependent="sub_category_id"
                                     name="main_category_id" id="main_category_id" required>
                                <option selected disabled>Kérem válasszon főkategóriát</option>
                                @foreach($mainCategories as $mainCategory)
                                    <option value="{{ $mainCategory->id }}">
                                        {{ $mainCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="main_category_id">Főkategória</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-2">
                            <select class="form-control select2" name="brand_id" id="brand_id" required>
                                <option selected disabled>Kérem válasszon márkát</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="brand_id">Márka</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-2">
                            <select class="form-control select2" name="sub_category_id"
                                         id="sub_category_id" required>
                                <option selected disabled>Kérem válasszon alkategóriát</option>
                            </select>
                            <label for="sub_category_id">Alkategória</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-2">
                            <select class="form-control select2" name="amount_unit_id"
                                        id="amount_unit_id" required>
                                <option selected disabled>Kérem válasszon mennyiségi egységet</option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}">
                                        {{ $unit->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="amount_unit_id">Mennyiségi egység</label>
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-2">
                    <textarea name="editor1" id="description"></textarea>
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

<!-- Image  Modal -->
<div class="modal" id="ImageModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Kép feltöltése</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                  <input type="file" name="image" id="image" class="form-control">
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-danger modelClose">Bezár</button>
                <button class="btn btn-success" id="SubmitImage">Mentés</button>
            </div>
        </div>
    </div>
</div>

<!--Image Delete  Modal -->
<div class="modal" id="DeleteImageModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Kép törlése</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h4>Biztos, hogy törölni szeretnéd a képet?</h4>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-danger modelClose">Nem</button>
                <button class="btn btn-success" id="SubmitDeleteImage">Igen</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

    <script type="text/javascript"
        src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js">
    </script>

    <script>
        CKEDITOR.replace( 'editor1' );
    </script>

    <script id="details-template" type="text/x-handlebars-template"
        src="{{ asset('js/admin/product/row.js') }}">
    </script>

    <script type="text/javascript"
        src="{{ asset('js/admin/product/product.js') }}">
    </script>

@endsection