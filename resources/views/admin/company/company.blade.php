@extends('admin.layouts.admin')

@section('content')

{{-- Index --}}
<div class="col-md-12">
    <div class="card mt-2">
        <div class="card-header">
            <h3 class="card-title">Cég adatok</h3>
            <div class="card-tools">
                <button id="SubmitForm" class="btn btn-success">
                    Mentés
                </button>            
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <input type="hidden" id="id" value="{{ $company->id ??'' }}">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="name" 
                                id="name" value="{{ $company->name ??'' }}" required>
                        <label for="name">Név</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-2">
                        <input type="email" class="form-control" name="email" 
                                id="email" value="{{ $company->email ??'' }}" required>
                        <label for="email">Email cím</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="phone" 
                                id="phone" value="{{ $company->phone ??'' }}" required>
                        <label for="phone">Telefonszám</label>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        
                        <div class="col-7" style="padding-right: 0px;">
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control"
                                        name="tax" id="tax" value="{{ $company->tax ??'' }}" required>
                                <label for="tax">Adószám</label>
                            </div>
                        </div>

                        <div class="col-2"  style="padding: 0px;">
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control"
                                    name="tax_vat" id="tax_vat" value="{{ $company->tax_vat ??'' }}" required>
                            </div>
                        </div>

                        <div class="col-3" style="padding-left: 0px;">
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" 
                                    name="tax_country" id="tax_country" value="{{ $company->tax_country ??'' }}" required>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-floating mb-2">
                        <input type="number" class="form-control" name="zip" 
                                    id="zip" value="{{ $company->zip ??'' }}" required>
                        <label for="zip">Irányítószám</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="city" 
                                    id="city" value="{{ $company->city ??'' }}" required>
                        <label for="city">Város</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="street" 
                                    id="street" value="{{ $company->street ??'' }}" required>
                        <label for="street">Utca</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="house_number" 
                                    id="house_number" value="{{ $company->house_number ??'' }}" required>
                        <label for="house_number">Házszám</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Editor -->
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-edit"></i>Oldalak
          </h3>
        </div>
        <div class="card-body">
            
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-content-below-profile-tab"
                        data-toggle="pill" href="#custom-content-below-profile" role="tab"
                        aria-controls="custom-content-below-profile" aria-selected="true">
                            A cégről
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-content-below-delivery-tab"
                        data-toggle="pill" href="#custom-content-below-delivery" role="tab"
                        aria-controls="custom-content-below-delivery" aria-selected="false">
                            Szállítás
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-content-below-faq-tab"
                        data-toggle="pill" href="#custom-content-below-faq" role="tab"
                        aria-controls="custom-content-below-faq" aria-selected="false">
                            Gyakori kérdések
                    </a>
                </li>
            </ul>

                <div class="tab-content" id="custom-content-below-tabContent">
                    <div class="tab-pane fade show active" id="custom-content-below-profile"
                            role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                        <form action="{{ route('description.profile') }}" method="post">
                            @csrf
                            <input class="btn btn-success mb-2 mt-2" type="submit" value="Mentés">
                            <input type="hidden" name="name" id="name" value="profile">
                            <textarea cols="80" id="profile" name="profile" rows="10"
                                data-sample-short><?= $profile->description ??'' ?></textarea>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="custom-content-below-delivery"
                            role="tabpanel" aria-labelledby="custom-content-below-delivery-tab">
                        <form action="{{ route('description.delivery') }}" method="post">
                            @csrf
                            <input class="btn btn-success mb-2 mt-2" type="submit" value="Mentés">
                            <input type="hidden" name="name" id="name" value="delivery">
                            <textarea cols="80" id="delivery" name="delivery" rows="10"
                                data-sample-short><?= $delivery->description ??'' ?></textarea>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="custom-content-below-faq"
                            role="tabpanel" aria-labelledby="custom-content-below-faq-tab">
                        <form action="{{ route('description.faq') }}" method="post">
                            @csrf
                            <input class="btn btn-success mb-2 mt-2" type="submit" value="Mentés">
                            <input type="hidden" name="name" id="name" value="faq">
                            <textarea cols="80" id="faq" name="faq" rows="10"
                                data-sample-short><?= $faq->description ??'' ?></textarea>
                        </form>
                    </div>
                </div>

        </div>
    </div>
</div>
    
@endsection

@section('script')

    <script type="text/javascript"
        src="https://cdn.ckeditor.com/4.16.2/standard-all/ckeditor.js">
    </script>

    <script type="text/javascript"
        src="{{ asset('js/admin/company/company.js') }}">
    </script>

@endsection