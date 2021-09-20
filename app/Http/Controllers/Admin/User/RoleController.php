<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\{Role, Permission};
use App\Models\Users\RoleForm;

class RoleController extends Controller
{
    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'permission' => ['required'],
    ];

    function __construct()
    {
         $this->middleware('permission:szerep-lista', ['only' => ['index']]);
         $this->middleware('permission:szerep-létrehozás', ['only' => ['create','store']]);
         $this->middleware('permission:szerep-szerkesztés', ['only' => ['edit','update']]);
         $this->middleware('permission:szerep-törlés', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()):
            $roles = Role::all();

            return \DataTables::of($roles)
                ->addColumn('Permissions', function($roles) {
                    $permissions = [];
                    foreach($roles->permissions as $permission):
                        $permissions[] .= $permission->name;
                    endforeach;
                    return implode(', ', $permissions);
                })
                ->addColumn('Actions', function($data) {
                return '<button class="btn btn-link btn-sm" id="getEdit" data-id="'.
                        $data->id.'"><i class="fas fa-edit fa-lg"></i></button>
                      <button class="btn btn-link btn-sm" id="getDelete" data-id="'.
                        $data->id.'"><i class="fas fa-trash fa-lg"></i></button>';
                })
                ->rawColumns(['Actions', 'Permissions'])
                ->make(true);
        endif;

        $permissions = Permission::all();

        return view('admin.user.role')
            ->with('permissions', $permissions);
    }

    public function store(Request $request)
    {
        array_push($this->rules['name'], 'unique:roles');
        $validator = \Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->getMessageBag()->toArray()]);
        }

        $role = Role::Create($request->all());
        $role->syncPermissions($request->permission);

        return response()->json(['success' =>
            'Szerep: '.$role->name.' sikeresen létrehozva!' ]);
    }

    public function edit($id)
    {
        $role = RoleForm::find($id);
        $html = $role->getEditForm();

        return response()->json(['html' => $html]);
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->getMessageBag()->toArray()]);
        }

        $role = Role::find($id);
        $role->name = $request->name;
        $role->update();

        $role->syncPermissions($request->permission);

        return response()->json(['success' =>
            'Szerep: '.$role->name.' sikeresen frissítve!']);
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        if(count($role->users) > 0){
            return response()->json(['success' =>
                'Nem törölhető olyan jogosultság, ami felhasználóhoz van kapcsolva!']);
        }
        $role->delete();
        $role->permissions()->detach();

        return response()->json(['success' =>
            'Szerep: '.$role->name.' sikeresen törölve!']);
    }
}
