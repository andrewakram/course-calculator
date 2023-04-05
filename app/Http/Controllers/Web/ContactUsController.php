<?php

namespace App\Http\Controllers\web;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    public function index()
    {
        $data['Page'] = Setting::get();
         
        $data['title_arabic'] = $data['Page']->where('key' ,'address_ar')->first()->value ;
        $data['title_english'] = $data['Page']->where('key' ,'address_en')->first()->value ;
        $data['phone'] = $data['Page']->where('key' ,'phone_1')->first()->value ;
		$data['email'] = $data['Page']->where('key' ,'email_1')->first()->value ;

  

        return view('Web.pages.contact_us' , compact('data'));
    }
}
