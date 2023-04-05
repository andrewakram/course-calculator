<?php

namespace App\Http\Controllers\MainAdmin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Center;
use App\Models\City;
use App\Models\Country;
use App\Models\Course;
use App\Models\Exam;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    public function index()
    {
        //counts for first row in page ....
        //first card
        $data['countries'] = Country::count();
        $data['cities'] = City::count();
        $data['courses'] = Course::count();
        $data['centers'] = Center::count();

        return view('MainAdmin.pages.home',
            compact('data'));
    }

}
