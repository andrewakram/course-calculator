<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class StudentRegisterController extends Controller
{
    public function index()
    {
        return view('Web.pages.student_register');
    }
}
