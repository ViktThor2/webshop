<?php

namespace App\Http\Controllers\Admin\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company\{Company, Description};

class CompanyController extends Controller
{
    protected $rules = [
        'name'  => 'required|max:255|string',
        'email' => 'required|max:255|string|email',
        'phone' => 'required|numeric',
        'tax'   => 'required|numeric',
        'tax_vat' => 'required|numeric',
        'tax_country' => 'required|numeric',
        'zip' => 'required|numeric',
        'street' => 'required|string|max:255',
        'house_number' => 'required|string|max:255'         
    ];

    function __construct()
    {
         $this->middleware('permission:cég-lista', ['only' => ['index']]);
         $this->middleware('permission:cég-létrehozás', ['only' => ['store']]);
    }

    public function index(Request $request)
    {
        $company = Company::first();

        $profile = Description::Search('profile')->first(); 
        if($profile) $profile->description = str_replace( '&', '&amp;', $profile->description );

        $delivery = Description::Search('delivery')->first(); 
        if($delivery) $delivery->description = str_replace( '&', '&amp;', $delivery->description );

        $faq = Description::Search('faq')->first();
        if($faq) $faq->description = str_replace( '&', '&amp;', $faq->description );

        return view('admin.company.company')
            ->with('company', $company)
            ->with('profile', $profile)
            ->with('delivery', $delivery)
            ->with('faq', $faq);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->getMessageBag()->toArray()]);
        }

        $company = Company::find($request->id);

        if($company == null):
            $company = new Company;
            $company->setData($request);
            $company->save();

            return response()->json(['success' =>
                'Cég: '.$company->name.' létrehozva']);
        else:
            $company->setData($request);
            $company->update();

            return response()->json(['success' => 
                'Cég: '.$company->name.' frissítve']);
        endif;
    }

}
