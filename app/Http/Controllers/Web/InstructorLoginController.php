<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class InstructorLoginController extends Controller
{
    public function index()
    {
        return view('Web.pages.instructor_login');
    }
}
