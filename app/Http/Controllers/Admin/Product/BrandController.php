<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products\Brand;
    
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()):
            $brands = Brand::all();

            return \DataTables::of($brands)
                ->addColumn('Actions', function($brands) {
                return '<button type="button" class="btn btn-link btn-sm" id="getEditBrandData" data-id="'.$brands->id.'"><i class="fas fa-edit fa-lg"></i></button>
                    <button type="button" data-id="'.$brands->id.'" data-toggle="modal" data-target="#DeleteBrandModal" class="btn btn-link btn-sm" id="getDeleteId"><i style="color:red" class="fas fa-trash-alt fa-lg"></i></button>';
                })
                ->rawColumns(['Actions'])
                ->make(true);
        endif;

        return view('admin.product.brand');
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
            'name' => 'required|string|max:255|unique:brands',
          ]);

        $brand = new Brand();
        $brand->setData($request);
        $brand->save();

        return response()->json(['success' => 'Márka létrehozva']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        $html = $brand->getEditForm();

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
            'name' => 'required|string|max:255',
          ]);

        $brand = Brand::find($id);
        $brand->setData($request);
        $brand->update();

        return response()->json(['success' => 'Márka frissítve']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);     
        if( count($brand->products) > 0):
            return response()->json(['error' => 
                'Nem törölhető olyan márka, amhiez termék van kapcsolva']);
        endif;
        $brand->delete();
        
        return response()->json(['success' => 'Márka törölve']);
    }
}
