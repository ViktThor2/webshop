<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products\AmountUnit;
    
class AmountUnitController extends Controller
{
    protected $rules = [
        'name' => 'required|max:255|string|unique:amount_units'
    ];

    public function index(Request $request)
    {
        if($request->ajax()):
            $units = AmountUnit::all();

            return \DataTables::of($units)
                ->addColumn('Actions', function($data) {
                return '<button class="btn btn-link btn-sm" id="getEdit" data-id="'.
                        $data->id.'"><i class="fas fa-edit fa-lg"></i></button>
                      <button class="btn btn-link btn-sm" id="getDelete" data-id="'.
                        $data->id.'"><i class="fas fa-trash fa-lg"></i></button>';
                })
                ->rawColumns(['Actions'])
                ->make(true);
        endif;

        return view('admin.product.unit');
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->getMessageBag()->toArray()]);
        }

        $unit = new AmountUnit();
        $unit->setData($request);
        $unit->save();

        return response()->json(['success' =>
         'Mennyiségi egység: '.$unit->name.' létrehozva']);
    }

    public function edit($id)
    {
        $unit = AmountUnit::find($id);
        $html = $unit->getEditForm();

        return response()->json(['html' => $html]);
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->getMessageBag()->toArray()]);
        }

        $unit = AmountUnit::find($id);
        $unit->setData($request);
        $unit->update();

        return response()->json(['success' => 
         'Mennyiségi egység: '.$unit->name.' frissítve']);
    }

    public function destroy($id)
    {
        $unit = AmountUnit::find($id);     
        if(count($unit->products) > 0):
            return response()->json(['errors' => 
            'Nem törölhető olyan mennyiségi egység, amhiez termék van kapcsolva']);
        endif;
        $unit->delete();
        
        return response()->json(['success' =>
         'Mennyiségi egység: '.$unit->name.' törölve']);
    }   
}
