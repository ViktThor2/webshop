<?php

namespace App\Http\Controllers\Admin\Product;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products\{
    Product, ProductForm, MainCategory, SubCategory, Brand,
    AmountUnit, Vat, ProductImage
};

class ProductController extends Controller
{
    protected $rules = [
        'name' => 'required|max:255|string',
        'netto' => 'required',
        'vat_sum' => 'required',
        'vat_id' => 'required',
        'brutto' => 'required',
        'amount_unit_id' => 'required'
    ];

    function __construct()
    {
         $this->middleware('permission:termék-lista', 
                                ['only' => ['index']]);
         $this->middleware('permission:termék-létrehozás', 
                                ['only' => ['create','store']]);
         $this->middleware('permission:termék-szerkesztés', 
                            ['only' => ['edit','update', 'changeActive']]);
         $this->middleware('permission:termék-törlés', 
                                ['only' => ['destroy']]);
         $this->middleware('permission:termék-kép-szerkesztés', 
                                ['only' => ['imageUpload', 'imageDelete']]);
    }

    public function index(Request $request)
    {      
        if( $request->ajax() ):

            if($request->search):
                $products = Product::Search($request)->get();
            else:
                $products = ProductForm::all();
            endif;

            foreach($products as $product):
                $product->getTableColumns();
            endforeach;
                
            return \DataTables::of($products)
                ->addColumn('Actions', function($data) {
                return '<button class="btn btn-link btn-sm" id="getImage" data-id="'.
                        $data->id.'"><i class="far fa-images fa-lg"></i></button>
                       <button class="btn btn-link btn-sm" id="getEdit" data-id="'.
                        $data->id.'"><i class="fas fa-edit fa-lg"></i></button>
                       <button class="btn btn-link btn-sm" id="getDelete" data-id="'.
                        $data->id.'"><i class="fas fa-trash fa-lg"></i></button>';
                })
                ->addColumn('Activate', function($products) {
                return '<input type="checkbox" class="published" id="getActive" data-id="'
                    .$products->id.'" '.($products->active == 0 ? : 'checked' ).'>';
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
        $validator = \Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->getMessageBag()->toArray()]);
        }

        $product = new Product();
        $product->setData($request);
        $product->save();

        return response()->json(['success' =>
         'Termék: '.$product->name.' létrehozva']);
    }

    public function edit($id)
    {
        $product = ProductForm::find($id);
        $html = $product->getEditForm();

        return response()->json(['html' => $html]);            
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->getMessageBag()->toArray()]);
        }

        $product = Product::find($id);
        $product->setData($request);
        $product->update();

        return response()->json(['success' =>
         'Termék: '.$product->name.' frissítve']);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json(['success' =>
         'Termék: '.$product->name.' törölve']);
    }

    public function changeActive($id)
    {
        $product = Product::findOrFail($id);
        $product->active = !$product->active;
        $product->save();

        if($product->active == true):
            return response()->json(['success' =>
             'Termék '.$product->name.' aktiválva']);
        endif;

        return response()->json(['success' =>
         'Termék '.$product->name.' inaktiválva']);
    }

    function fetch($id)
    {
        $data = SubCategory::Select($id)->get();
        $output = '<option value="" selected>Kérem válasszon alkategóriát</option>';
        
        if(count($data) == 0):
            $output .= '<option disabled>Nincs alkategória</option>';
        else:
            foreach ($data as $row) {
                $output .= '<option value="'.$row->id. '">'.$row->name.'</option>';
            }
        endif;

        echo $output;
    }

    public function imageUpload(Request $request)
    {
        $rule = ['image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'];
        
        $validator = \Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->getMessageBag()->toArray()]);
        }

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('img/product'), $imageName);

        $product = Product::find($request->id);
        if(count($product->product_images) == 4){
            return response()->json(['errors' =>
                'Egy terméknek maximum 4 képe lehet!']);
        }

        $productImage = new ProductImage();
        $productImage->setData($request->id, $imageName);
        $productImage->save();

        return response()->json(['success' =>
         'A '.$productImage->product->name.' képe sikeresen feltöltve!']);
    }

    public function imageDelete(Request $request)
    {
        $productImage = ProductImage::ProductImage(
            $request->product, $request->image)->first();

        unlink(public_path('img/product/'.$productImage->image));
        $productImage->delete();

        return response()->json(['success' =>
        'A '.$productImage->product->name.' képe sikeresen törölve!']);
    }
}
