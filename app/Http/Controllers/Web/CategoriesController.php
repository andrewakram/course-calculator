<?php

namespace App\Http\Controllers\web;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{

    public function index()
    {
        $data['categories'] =  Category::select('id','title_' . getLang() . '  as title' ,'image')->withCount(['courses'])->get();
        return view('Web.pages.category' , compact('data'));
    }

    
}
