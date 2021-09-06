<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products\AmountUnit;
    
class AmountUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()):
            $units = AmountUnit::all();

            return \DataTables::of($units)
                ->addColumn('Actions', function($units) {
                return '<button type="button" class="btn btn-link btn-sm" id="getEditUnitData" data-id="'.$units->id.'"><i class="fas fa-edit fa-lg"></i></button>
                    <button type="button" data-id="'.$units->id.'" data-toggle="modal" data-target="#DeleteUnitModal" class="btn btn-link btn-sm" id="getDeleteId"><i style="color:red" class="fas fa-trash-alt fa-lg"></i></button>';
                })
                ->rawColumns(['Actions'])
                ->make(true);
        endif;

        return view('admin.product.unit');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
         ]);

        $unit = new AmountUnit();
        $unit->setData($request);
        $unit->save();

        return response()->json(['success' => 'Mennyiségi egység létrehozva']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = AmountUnit::find($id);
        $html = $unit->getEditForm();

        return response()->json(['html' => $html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
         ]);
         
        $unit = AmountUnit::find($id);
        $unit->setData($request);
        $unit->update();

        return response()->json(['success' => 'Mennyiségi egység frissítve']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = AmountUnit::find($id);
        if( count($unit->products) > 0):
            return response()->json(['error' => 
            'Nem törölhető olyan mennyiségi egység, amihez termék kapcsolódik']);
        endif;
        $unit->delete();
        
        return response()->json(['success' => 'Mennyiségi egység törölve']);
    }
}
