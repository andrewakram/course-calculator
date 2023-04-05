<?php

namespace App\Http\Controllers\Web;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class InstructorRegisterController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::select('id','title_' . getLang() . '  as title')->get();

        return view('Web.pages.instructor_register',compact('data'));
    }

}
