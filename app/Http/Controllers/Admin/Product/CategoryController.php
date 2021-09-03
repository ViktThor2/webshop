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
                return '<button type="button" class="btn btn-link btn-sm" id="getEditCategoryData" data-id="'.$categories->id.'"><i class="fas fa-edit fa-lg"></i></button>
                    <button type="button" data-id="'.$categories->id.'" data-toggle="modal" data-target="#DeleteCategoryModal" class="btn btn-link btn-sm" id="getDeleteId"><i style="color:red" class="fas fa-trash-alt fa-lg"></i></button>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
        endif;    

        return view('admin.product.category');
    }
}

