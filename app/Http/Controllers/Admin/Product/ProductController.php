<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products\{
    Product, ProductTable, MainCategory, SubCategory, Brand, AmountUnit, Vat
};

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()):
            $products = ProductTable::all();

            foreach($products as $product):
                $product->getColumns();
            endforeach;
                
            return \DataTables::of($products)
                ->addColumn('Actions', function($products) {
                    return '<button type="button" class="btn btn-link btn-sm" id="getEditProductData" data-id="'.$products->id.'"><i class="fas fa-edit fa-lg"></i></button>
                        <button type="button" data-id="'.$products->id.'" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-link btn-sm" id="getDeleteId"><i style="color:red" class="fas fa-trash-alt fa-lg"></i></button>';
                })
                ->addColumn('Activate', function($products) {
                    return '<input type="checkbox" class="published" id="getActive" data-id="'.$products->id.'" '.($products->active == 0 ? : 'checked' ).'>';
                })
                ->rawColumns(['Actions', 'Activate'])
                ->make(true);
        endif;

        $mainCategories = MainCategory::all();
        $subCategories = SubCategory::all();
        $brands = Brand::all();
        $units = AmountUnit::all();
        $vats = Vat::all(); 

        return view('admin.product.product')
            ->with('mainCategories', $mainCategories)
            ->with('subCategories', $subCategories)
            ->with('brands', $brands)
            ->with('units', $units)
            ->with('vats', $vats);
            
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->setData($request);
        $subCategory = SubCategory::find($request->sub_category_id);
        $product->main_category_id = $subCategory->main_category->id;
        $product->save();

        return response()->json(['success' => 'Termék létrehozva']);
    }

    public function edit($id)
    {
        $product = ProductTable::find($id);
        $html = $product->getEditForm();

        return response()->json(['html' => $html]);            
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->setData($request);
        $subCategory = SubCategory::find($request->sub_category_id);
        $product->main_category_id = $subCategory->main_category->id;
        $product->update();

        return response()->json(['success' => 'Termék frissítve']);
    }

    public function destroy($id)
    {
        Product::destroy($id);

        return response()->json(['success' => 'Termék törölve']);
    }

    public function changeActive($id)
    {
        $product = Product::findOrFail($id);
        $product->active = !$product->active;
        $product->save();

        if($product->active == true):
            return response()->json(['success' => 'Termék '.$product->name.' aktiválva']);
        endif;

        return response()->json(['success' => 'Termék '.$product->name.' inaktiválva']);
    }

}
