@extends('admin.layouts.admin')

@section('content')

    <script>
        function bruttoCalc() {
                const netto = $('#netto').val() *1;
                const vat = $('#vat_id').val() *1;

                const vat_sum = netto * vat / 100;
                const brutto = vat_sum + netto;
                
                if (brutto != null) {
                    document.getElementById("vat_sum").value = vat_sum;
                    document.getElementById("brutto").value = brutto;
                }
        }

        function nettoCalc() {
                const brutto = $('#brutto').val() *1;
                const vat = $('#vat_id').val() *1;

                const netto = brutto / ((100 + vat) / 100);
                const vat_sum = brutto - netto;
                
                if (netto != null) {
                    document.getElementById("vat_sum").value = vat_sum;
                    document.getElementById("netto").value = netto;
                }
        }
        
        function editBruttoCalc() {
                const netto = $('#editNetto').val() *1;
                const vat = $('#editVat_id').val() *1;

                const vat_sum = netto * vat / 100;
                const brutto = vat_sum + netto;
                
                if (brutto != null) {
                    document.getElementById("editVat_sum").value = vat_sum;
                    document.getElementById("editBrutto").value = brutto;
                }
        }

        function editNettoCalc() {
                const brutto = $('#editBrutto').val() *1;
                const vat = $('#editVat_id').val() *1;

                const netto = brutto / ((100 + vat) / 100);
                const vat_sum = brutto - netto;
                
                if (netto != null) {
                    document.getElementById("editVat_sum").value = vat_sum;
                    document.getElementById("editNetto").value = netto;
                }
        }
    </script>

    {{-- Index --}}
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                Termékek
                <button id="new_button" class="btn btn-success" type="button"  
                        data-toggle="modal" data-target="#ProductModal">
                    <i class="fas fa-plus fa-sm"></i>Új
                </button>
            </div>
            <div class="card-body">

                <table class="table table-condensed table-bordered
                        table-hover datatable" id="products-table">
                    <thead style="font-size: 16px">
                        <tr style="font-size: 18px">
                            <th class="align-middle">Id</th>
                            <th class="align-middle">Név</th>
                            <th class="align-middle">Főkategória</th>
                            <th class="align-middle">Alkategória</th>
                            <th class="align-middle">Márka</th>
                            <th class="align-middle">Nettó</th>
                            <th class="align-middle">Áfa</th>
                            <th class="align-middle">Bruttó</th>
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
    <div class="modal" id="ProductModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Termék létrehozása</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body" id="ProductModalBody">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                        <strong>Siker! </strong>Termék létrehozva.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Név" required>
                        <label for="name">Név</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-2">
                                <select class="form-control select2" name="vat_id" id="vat_id" aria-label="Floating label select" required>
                                    <option selected disabled>Válasszon ÁFÁ-t</option>
                                    @foreach($vats as $vat)
                                        <option value="{{ $vat->name }}"> {{ $vat->name }} %</option>
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
                        <select class="form-control" name="category_id" id="category_id">
                            <option selected disabled>Kérem válasszon kategóriát</option>
                            @foreach($mainCategories as $mainCategory)
                                <option value="{{$mainCategory->id}}">{{$mainCategory->name}}</option>
                                @foreach($mainCategory->sub_category as $sub)
                                    <option value="{{$sub->id}}">-{{$sub->name}}</option>
                                @endforeach
                            @endforeach
                        </select>
                        <label for="sub_category_id">Kategória</label>
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
                        <select class="form-control select2" name="amount_unit_id" id="amount_unit_id" required>
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
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Bezár</button>
                    <button type="button" class="btn btn-success" id="SubmitCreateProductForm">Mentés</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit  Modal -->
    <div class="modal" id="EditProductModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Termék szerkesztése</h4>
                    <button type="button" class="close modelClose" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body" id="EditProductModalBody">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                        <strong>Siker!</strong>Termék frissítve.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">Bezár</button>
                    <button type="button" class="btn btn-success" id="SubmitEditProductForm">Mentés</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Delete  Modal -->
    <div class="modal" id="DeleteProductModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Termék törlése</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h4>Biztos, hogy törölni szeretnéd a terméket?</h4>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Nem</button>
                    <button type="button" class="btn btn-success" id="SubmitDeleteProductForm">Igen</button>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')

    <script type="text/javascript">
        $(document).ready(function() 
        {
            // init datatable.
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 10,
                "order": [[ 0, "desc" ]],
                ajax: {
                    url: '{{ route('product.index') }}'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'main_category_id', name: 'main_category_id'},
                    {data: 'sub_category_id', name: 'sub_category_id'},
                    {data: 'brand_id', name: 'brand_id'},
                    {data: 'netto', name: 'netto'},
                    {data: 'vat_sum', name: 'vat_sum'},
                    {data: 'brutto', name: 'brutto'},
                    {data: 'qty', name: 'qty'},
                    {data: 'active', name: 'active'},
                    {
                        data: 'Actions', name: 'Actions',
                        orderable:false, serachable:false,sClass:'text-center'
                    },
                ],
            });

            // Create article Ajax request.
            $('#SubmitCreateProductForm').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('product.store') }}",
                    method: 'post',
                    data: {
                        name: $('#name').val(),
                        netto: $('#netto').val(),
                        vat_sum: $('#vat_sum').val(),
                        vat_id: $('#vat_id').val(),
                        brutto: $('#brutto').val(),
                        qty: 0  ,
                        sub_category_id: $('#sub_category_id').val(),
                        brand_id: $('#brand_id').val(),
                        amount_unit_id: $('#amount_unit_id').val(),
                        description: $('#description').val(),
                        active: 1,
                    },
                    success: function(result) {
                        if(result.errors) {
                            $('.alert-danger').html('');
                            $.each(result.errors, function(key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                            });
                        } else {
                            $('.alert-danger').hide();
                            $('.alert-success').show();
                            $('.datatable').DataTable().ajax.reload();
                            setInterval(function(){
                                $('.alert-success').hide();
                                $('#CreateProductModal').modal('hide');
                                location.reload();
                            }, 2000);
                        }
                    }
                });
            });

            // Get single article in EditModel
            $('.modelClose').on('click', function(){
                $('#EditProductModal').hide();
            });
            var id;
            $('body').on('click', '#getEditProductData', function(e) {
                // e.preventDefault();
                $('.alert-danger').html('');
                $('.alert-danger').hide();
                    id = $(this).data('id');
                $.ajax({
                    url: "product/"+id+"/edit",
                    method: 'GET',
                    success: function(result) {
                        console.log(result);
                        $('#EditProductModalBody').html(result.html);
                        $('#EditProductModal').show();
                    }
                });
            });
        
            // Update  Ajax request.
            $('#SubmitEditProductForm').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "product/"+id,
                    method: 'PUT',
                    data: {
                        name: $('#editName').val(),
                        netto: $('#editNetto').val(),
                        vat_sum: $('#editVat_sum').val(),
                        vat_id: $('#editVat_id').val(),
                        brutto: $('#editBrutto').val(),
                        sub_category_id: $('#editSub_category_id').val(),
                        brand_id: $('#editBrand_id').val(),
                        amount_unit_id: $('#editAmount_unit_id').val(),
                        description: $('#editDescription').val(),
                        qty: 0  ,
                        active: 1,
                    },
                    success: function(result) {
                        if(result.errors) {
                            $('.alert-danger').html('');
                            $.each(result.errors, function(key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                            });
                        } else {
                            $('.alert-danger').hide();
                            $('.alert-success').show();
                            location.reload();
                            setInterval(function(){
                                $('.alert-success').hide();
                                $('#EditProductModal').hide();
                            }, 2000);
                        }
                    }
                });
            });


            // Delete  request.
            var deleteID;
            $('body').on('click', '#getDeleteId', function(){
                deleteID = $(this).data('id');
            })
            $('#SubmitDeleteProductForm').click(function(e) {
                e.preventDefault();
                var id = deleteID;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "product/"+id,
                    method: 'DELETE',
                    success: function(result) {
                        setInterval(function(){
                            location.reload();
                            $('#DeleteProductModal').hide();
                        }, 1000);
                    }
                });
            });


        }); 
    </script>
@endsection