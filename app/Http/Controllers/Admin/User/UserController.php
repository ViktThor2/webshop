<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'roles' => ['required'],
    ];
    
    function __construct()
    {
         $this->middleware('permission:felhasználó-lista', ['only' => ['index']]);
         $this->middleware('permission:felhasználó-létrehozás', ['only' => ['create','store']]);
         $this->middleware('permission:felhasználó-szerkesztés', ['only' => ['edit','update']]);
         $this->middleware('permission:felhasználó-törlés', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()):
            $users = User::all();
            
            return \DataTables::of($users)
                ->addColumn('Role', function ($users) {
                    if(!empty($users->getRoleNames())):
                        foreach($users->getRoleNames() as $v):
                            return $v;
                        endforeach;
                    endif;
                })
                ->addColumn('Actions', function($data) {
                return '<button class="btn btn-link btn-sm" id="getEdit" data-id="'.
                        $data->id.'"><i class="fas fa-edit fa-lg"></i></button>
                      <button class="btn btn-link btn-sm" id="getDelete" data-id="'.
                        $data->id.'"><i class="fas fa-trash fa-lg"></i></button>';
                })
                ->rawColumns(['Actions'])
                ->make(true);
        endif;

        $roles = Role::pluck('name','name')->all();

        return view('admin.user.user')
            ->with('roles', $roles);
    }

    public function store(Request $request)
    {
        array_push($this->rules['email'], 'unique:users');
        $validator = \Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->getMessageBag()->toArray()]);
        }

        $user = new User;
        $user->setData($request);
        $user->save();

        $user->assignRole($request->roles);

        return response()->json(['success' =>
            'Felhasználó '.$user->name.' sikeresen létrehozva!' ]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $html = $user->getEditForm();

        return response()->json(['html' => $html]);
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->getMessageBag()->toArray()]);
        }

        $user = User::find($id);
        $user->setData($request);
        $user->update();
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->roles);

        return response()->json(['success' =>
            'Felhasználó '.$user->name.' sikeresen frissítve!']);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if($user->id == \Auth::guard()->user()->id){
            return response()->json(['errors' =>
             'Nem törölheti a saját felhasználói fiókját!']);
        }
        $user->delete();

        return response()->json(['success' =>
            'Felhasználó '.$user->name.' sikeresen törölve!']);
    }
}
