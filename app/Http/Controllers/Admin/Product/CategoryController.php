<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products\{ 
    MainCategory, SubCategory, CategoryTable 
};

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()):
            $categoryTable = new CategoryTable();
            $categories = $categoryTable->getColumns();
            
            return \DataTables::of($categories)
                ->addColumn('Actions', function($categories) {
                    if($categories->sub == '-'):
                        return '<button type="button" class="btn btn-link btn-sm" id="getEditMainCategoryData" data-id="'.$categories->id.'"><i class="fas fa-edit fa-lg"></i></button>
                         <button type="button" data-id="'.$categories->id.'" data-toggle="modal" data-target="#DeleteMainCategoryModal" class="btn btn-link btn-sm" id="getDeleteMainId"><i style="color:red" class="fas fa-trash-alt fa-lg"></i></button>';
                    else:
                        return '<button type="button" class="btn btn-link btn-sm" id="getEditSubCategoryData" data-id="'.$categories->id.'"><i class="fas fa-edit fa-lg"></i></button>
                         <button type="button" data-id="'.$categories->id.'" data-toggle="modal" data-target="#DeleteSubCategoryModal" class="btn btn-link btn-sm" id="getDeleteSubId"><i style="color:red" class="fas fa-trash-alt fa-lg"></i></button>';
                    endif;
                })
            ->rawColumns(['Actions'])
            ->make(true);
        endif;

        $mainCategories = MainCategory::all();

        return view('admin.product.category')
            ->with('mainCategories', $mainCategories);
    }

    public function store(Request $request)
    {
        if(!$request->main_category_id):
            $this->validate($request, [
                'name' => 'required',
             ]);
            $mainCategory = new MainCategory();
            $mainCategory->setData($request);
            $mainCategory->save();

            return response()->json(['success' => 'Főkategória létrhozva']);
        else:
            $this->validate($request, [
                'name' => 'required',
                'main_category_id' => 'required'
             ]);
            $subCategory = new SubCategory();
            $subCategory->setData($request);
            $subCategory->save();

            return response()->json(['success' => 'Alkategória létrhozva']);
        endif;
    }

    public function edit($id)
    {
        $category = MainCategory::find($id);
        $html = $category->getEditForm();

        return response()->json(['html' => $html]);            
    }

    public function editsub($id)
    {
        $category = SubCategory::find($id);
        $html = $category->getEditForm();

        return response()->json(['html' => $html]);            
    }

    public function update($id, Request $request)
    {
        if(!$request->main_category_id):
            $this->validate($request, [
                'name' => 'required',
             ]);
            $mainCategory = MainCategory::find($id);
            $mainCategory->setData($request);
            $mainCategory->update();

            return response()->json(['success' => 'Főkategória frissítve']);
        else:
            $subCategory = SubCategory::find($id);
            $this->validate($request, [
                'name' => 'required',
                'main_category_id' => 'required'
             ]);
            $subCategory->setData($request);
            $subCategory->update();

            return response()->json(['success' => 'Alkategória frissítve']);
        endif;
    }

    public function destroy($id)
    {
        $mainCategory = MainCategory::find($id);
        if($mainCategory->products):
            return response()->json([['error' => 'Nem törölhető olyan kategória, amihez tartozik termék']]);
        endif;
        $mainCategory->deleteSub();
        $mainCategory->delete();

        return response()->json(['success' => 'Főkategória törölve']);
    }

    public function destroysub($id)
    {
        $subCategory = SubCategory::find($id);
        if($subCategory->products):
            return response()->json([['error' => 'Nem törölhető olyan kategória, amihez tartozik termék']]);
        endif;
        $subCategory->delete();

            
        return response()->json(['success' => 'Alkategória törölve']);
    }

}

