<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products\Brand;
    
class BrandController extends Controller
{
    protected $rules = [
        'name' => 'required|max:255|string|unique:brands'
    ];

    public function index(Request $request)
    {
        if($request->ajax()):
            $brands = Brand::all();

            return \DataTables::of($brands)
                ->addColumn('Actions', function($data) {
                return '<button class="btn btn-link btn-sm" id="getEdit" data-id="'.
                        $data->id.'"><i class="fas fa-edit fa-lg"></i></button>
                       <button class="btn btn-link btn-sm" id="getDelete" data-id="'.
                        $data->id.'"><i class="fas fa-trash fa-lg"></i></button>';
                })
                ->rawColumns(['Actions'])
                ->make(true);
        endif;

        return view('admin.product.brand');
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->getMessageBag()->toArray()]);
        }

        $brand = new Brand();
        $brand->setData($request);
        $brand->save();

        return response()->json(['success' =>
         'Márka: '.$brand->name.' létrehozva']);
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        $html = $brand->getEditForm();

        return response()->json(['html' => $html]);
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->getMessageBag()->toArray()]);
        }

        $brand = Brand::find($id);
        $brand->setData($request);
        $brand->update();

        return response()->json(['success' =>
         'Márka: '.$brand->name.' frissítve']);
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
        if(count($brand->products) > 0):
            return response()->json(['errors' => 
                'Nem törölhető olyan márka, amhiez termék van kapcsolva']);
        endif;
        $brand->delete();
        
        return response()->json(['success' =>
         'Márka: '.$brand->name.' törölve']);
    }
}
