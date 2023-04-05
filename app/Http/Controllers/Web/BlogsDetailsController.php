<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogsDetailsController extends Controller
{
    public function index()
    {
        return view('Web.pages.blog_details');
    }
}
