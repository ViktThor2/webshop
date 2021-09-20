<?php

namespace App\Http\Controllers\Admin\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company\Description;

class DescriptionController extends Controller
{
    public function profile(Request $request)
    {
        $description = Description::Search('profile')->first();
        
        if($description == null):
            $description = new Description;
            $description->setData('profile', $request->profile);
            $description->save();
        else:
            $description->description = $request->profile;
            $description->update();
        endif;

        return redirect()->route('company.index');
    }

    public function delivery(Request $request)
    {
        $description = Description::Search('delivery')->first();
        
        if($description == null):
            $description = new Description;
            $description->setData('delivery', $request->delivery);
            $description->save();
        else:
            $description->description = $request->delivery;
            $description->update();
        endif;

        return redirect()->route('company.index');
    }

    public function faq(Request $request)
    {
        $description = Description::Search('faq')->first();
        
        if($description == null):
            $description = new Description;
            $description->setData('faq', $request->faq);
            $description->save();
        else:
            $description->description = $request->faq;
            $description->update();
        endif;

        return redirect()->route('company.index');
    }
}
