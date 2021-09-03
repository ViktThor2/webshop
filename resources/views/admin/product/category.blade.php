@extends('admin.layouts.admin')

@section('content')

    {{-- Index --}}
    <div class="col-12">
        <div class="card mt-2">
            <div class="card-header">
                Kategóriák
                <button id="new_button" class="btn btn-success" type="button"  
                        data-toggle="modal" data-target="#CategoryModal">
                    <i class="fas fa-plus fa-sm"></i>Új
                </button>
            </div>
            <div class="card-body">

                <table class="table table-condensed table-bordered
                        table-hover datatable" id="products-table">
                    <thead style="font-size: 16px">
                        <tr style="font-size: 18px">
                            <th width="50%" class="align-middle">Főkategória</th>
                            <th class="align-middle">Alkategória</th>
                            <th width="100px"></th>
                        </tr>
                    </thead>
                </table>

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
                "order": [[ 0, "asc" ]],
                ajax: {
                    url: '{{ route('category.index') }}'
                },
                columns: [
                    {data: 'main', name: 'main'},
                    {data: 'sub', name: 'sub'},
                    {
                        data: 'Actions', name: 'Actions',
                        orderable:false, serachable:false,sClass:'text-center'
                    },
                ],
            });

        
        }); 
    </script>
@endsection