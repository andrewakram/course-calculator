<?php

namespace App\Http\Controllers\MainAdmin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
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
        $data['supervisors'] = 0;
        $data['instructors'] = 0;
        $data['students'] = 0;

        return view('MainAdmin.pages.home',
            compact('data'));
    }

}
