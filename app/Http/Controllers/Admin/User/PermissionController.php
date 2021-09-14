<?php

namespace App\Http\Controllers\Admin\User;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    protected $rules = [
        'name' => ['required', 'string', 'max:255']
    ];

    function __construct()
    {
/*          $this->middleware('permission:jogosultság-lista', ['only' => ['index']]);
         $this->middleware('permission:jogosultság-létrehozás', ['only' => ['create','store']]);
         $this->middleware('permission:jogosultság-szerkesztés', ['only' => ['edit','update']]);
         $this->middleware('permission:jogosultság-törlés', ['only' => ['destroy']]); */
    }

    public function index(Request $request)
    {
        if($request->ajax()):
            $permissions = Permission::all();

            return \DataTables::of($permissions)
                ->addColumn('Actions', function($data) {
                return '<button class="btn btn-link btn-sm" id="getEdit" data-id="'.
                        $data->id.'"><i class="fas fa-edit fa-lg"></i></button>
                      <button class="btn btn-link btn-sm" id="getDelete" data-id="'.
                        $data->id.'"><i class="fas fa-trash fa-lg"></i></button>';
                })
                ->rawColumns(['Actions'])
                ->make(true);
        endif;

        return view('admin.user.permission');
    }

    public function store(Request $request)
    {
        array_push($this->rules['name'], 'unique:permissions');
        $validator = \Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->getMessageBag()->toArray()]);
        }

        $permission = Permission::create($request->all());

        return response()->json(['success' =>
            'Jogosultság: '.$permission->name.' sikeresen létrehozva!' ]);
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        $html = $permission->getEditForm();

        return response()->json(['html' => $html]);
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->getMessageBag()->toArray()]);
        }

        $permission = Permission::find($id);
        $permission->setData($request);
        $permission->update();

        return response()->json(['success' =>
            'Jogosultság: '.$permission->name.' sikeresen frissítve!']);
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        if(count($permission->roles) > 0){
            return response()->json(['success' =>
                'Nem törölhető olyan jogosultság, ami szerephez van kapcsolva!']);
        }
        $permission->delete();

        return response()->json(['success' =>
            'Jogosultság: '.$permission->name.' sikeresen törölve!']);
    }
}
