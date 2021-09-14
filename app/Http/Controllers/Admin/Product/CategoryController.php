<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products\{ 
    MainCategory, SubCategory, CategoryTable 
};

class CategoryController extends Controller
{
    protected $rulesMain = [
        'name' => 'required|max:255|string|unique:main_categories'
    ];

    protected $rulesSub = [
        'name' => 'required|max:255|string|unique:sub_categories',
        'main_category_id' => 'required'
    ];

    function __construct()
    {
         $this->middleware('permission:kategória-lista', ['only' => ['index']]);
         $this->middleware('permission:kategória-létrehozás', ['only' => ['create','store']]);
         $this->middleware('permission:kategória-szerkesztés', ['only' => ['edit','update']]);
         $this->middleware('permission:kategória-törlés', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()):
            $categoryTable = new CategoryTable();
            $categories = $categoryTable->getColumns();
            
            return \DataTables::of($categories)
                ->addColumn('Actions', function($data) {
                if($data->sub == '-'): return
                    '<button class="btn btn-link btn-sm" id="getEditMain" data-id="'.
                       $data->id.'"><i class="fas fa-edit fa-lg"></i></button>
                    <button class="btn btn-link btn-sm" id="getDeleteMain" data-id="'.
                       $data->id.'"><i class="fas fa-trash fa-lg"></i></button>';
                else: return
                    '<button class="btn btn-link btn-sm" id="getEditSub" data-id="'.
                       $data->id.'"><i class="fas fa-edit fa-lg"></i></button>
                    <button class="btn btn-link btn-sm" id="getDeleteSub" data-id="'.
                       $data->id.'"><i class="fas fa-trash fa-lg"></i></button>';
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

            $validator = \Validator::make($request->all(), $this->rulesMain);
            if ($validator->fails()) {
                return response()->json(
                    ['errors' => $validator->getMessageBag()->toArray()]);
            }
    
            $mainCategory = new MainCategory();
            $mainCategory->setData($request);
            $mainCategory->save();

            return response()->json(['success' =>
             'Főkategória: '.$mainCategory->name.' létrhozva']);
        else:

            $validator = \Validator::make($request->all(), $this->rulesSub);
            if ($validator->fails()) {
                return response()->json(
                    ['errors' => $validator->getMessageBag()->toArray()]);
            }
    
            $subCategory = new SubCategory();
            $subCategory->setData($request);
            $subCategory->save();

            return response()->json(['success' =>
             'Alkategória: '.$subCategory->name.' létrhozva']);
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

            $validator = \Validator::make($request->all(), $this->rulesMain);
            if ($validator->fails()) {
                return response()->json(
                    ['errors' => $validator->getMessageBag()->toArray()]);
            }

            $mainCategory = MainCategory::find($id);
            $mainCategory->setData($request);
            $mainCategory->update();

            return response()->json(['success' =>
             'Főkategória: '.$mainCategory->name.' frissítve']);
        else:

            $validator = \Validator::make($request->all(), $this->rulesMain);
            if ($validator->fails()) {
                return response()->json(
                    ['errors' => $validator->getMessageBag()->toArray()]);
            }

            $subCategory = SubCategory::find($id);
            $subCategory->setData($request);
            $subCategory->update();

            return response()->json(['success' =>
             'Alkategória: '.$mainCategory->name.' frissítve']);
        endif;
    }

    public function destroy($id)
    {
        $mainCategory = MainCategory::find($id);
        if(count($mainCategory->products) > 0):
            return response()->json([['errors' =>
             'Nem törölhető olyan kategória, amihez tartozik termék']]);
        endif;
        $mainCategory->deleteSub();
        $mainCategory->delete();

        return response()->json(['success' =>
         'Főkategória: '.$mainCategory->name.' törölve']);
    }

    public function destroysub($id)
    {
        $subCategory = SubCategory::find($id);
        if(count($subCategory->products) > 0):
            return response()->json([['errors' => 
                'Nem törölhető olyan kategória, amihez tartozik termék']]);
        endif;
        $subCategory->delete();

        return response()->json(['success' =>
         'Alkategória: '.$subCategory->name.' törölve']);
    }

}

