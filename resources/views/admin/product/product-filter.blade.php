<div class="card mt-2">
    <div class="card-header">
      <h3 class="card-title">Kereső</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
          <div class="col-4">
                {{-- Main Category --}}
                <div class="form-group">
                    <select class="form-control select2" name="main_category"
                            id="main_category" data-dependent="sub_category" >
                        <option value="" selected>Kérem válasszon főkategóriát</option>
                        @foreach($mainCategories as $mainCategory)
                            <option value="{{ $mainCategory->id }}">
                                {{ $mainCategory->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- Sub Category --}}
                <div class="form-group">
                    <select class="form-control select2" name="sub_category"
                                    id="sub_category">
                        <option value="" selected>Kérem válasszon alkategóriát</option>
                    </select>
                </div>
          </div>
          <div class="col-4">
                {{-- Brand --}}
                <div class="form-group">
                    <select class="form-control select2" name="brand" id="brand">
                        <option value="" selected>Kérem válasszon márkát</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- Price --}}
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <input type="number" class="form-control" name="price-min"
                                  id="price-min" placeholder="Minimum ár">
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="price-max"
                                  id="price-max" placeholder="Maximum ár">
                        </div>
                    </div>
                </div>
          </div>
          <div class="col-4">

          </div>
      </div>
    </div>
  </div>