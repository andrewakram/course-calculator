<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class StudentLoginController extends Controller
{
    public function index()
    {
        return view('Web.pages.student_login');
    }
}
