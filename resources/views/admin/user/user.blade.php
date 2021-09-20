@extends('admin.layouts.admin')

@section('content')

{{-- Index --}}
<div class="col-md-12">
    <div class="card mt-2">
        <div class="card-header">
            <h3 class="card-title">Felhasználók</h3>
            <div class="card-tools">
                <button id="new_button" class="btn btn-success">
                    <i class="fas fa-plus fa-sm"></i>Új
                </button>            
            </div>
        </div>
        <div class="card-body">
            <table class="table table-condensed table-bordered table-hover datatable">
                <thead>
                    <tr>
                        <th class="align-middle">Név</th>
                        <th class="align-middle">Email cím</th>
                        <th class="align-middle">Szerep</th>
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
                <h4 class="modal-title">Felhasználó létrehozása</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body" id="ModalBody">
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" 
                            name="name" id="name" placeholder="Név" required>
                    <label for="name">Név</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="email" class="form-control" 
                            name="email" id="email" placeholder="Email cím" required>
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" class="form-control" 
                            name="password" id="password" placeholder="Jelszó" required>
                    <label for="password">Jelszó</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" class="form-control" 
                            name="password_confirmation" id="password_confirmation"
                            placeholder="Jelszó megerősítése" required>
                    <label for="password_confirmation">Jelsó megerősítése</label>
                </div>
                <div class="form-floating mb-2">
                    <select class="form-control select2" name="role" id="role">
                        <option selected disabled>Kérem válasszon szerepet</option>
                        @foreach($roles as $role)
                            <option value="{{ $role }}">
                                {{ $role }}
                            </option>
                        @endforeach
                    </select>
                    <label for="role">Szerep</label>
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
                <h4 class="modal-title">Felhasználó szerkesztése</h4>
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
                <h4 class="modal-title">Felhasználó törlése</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h5>Biztos, hogy törölni szeretnéd a felhasználót?</h5>
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
        src="{{ asset('js/admin/user/user.js') }}">
    </script>
@endsection