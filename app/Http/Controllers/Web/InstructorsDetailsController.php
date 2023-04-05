<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstructorsDetailsController extends Controller
{
    public function index()
    {
        return view('Web.pages.instructor_details');
    }
}
