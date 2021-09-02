<?php

namespace App\Http\Controllers\Admin;

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
                ->rawColumns(['Actions'])
                ->make(true);
        endif;

        $mainCategories = MainCategory::all();
        $subCategories = SubCategory::all();
        $brands = Brand::all();
        $units = AmountUnit::all();
        $vats = Vat::all();

        return view('admin.product.index')
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
        $product = Product::destroy($id);

        return response()->json(['success' => 'Termék törölve']);
    }

}
