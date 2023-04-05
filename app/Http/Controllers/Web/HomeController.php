<?php

namespace App\Http\Controllers\Web;

use App\Models\Accomodation;
use App\Models\Center;
use App\Models\City;
use App\Models\CityCourse;
use App\Models\Country;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    public function index()
    {
        $countries = Country::get();
        return view('Web.pages.home',compact('countries'));
    }

    public function calculatePrice(Request $request)
    {
        $data = [];
        $data['country'] = Country::whereId($request->country_id)->first();
        $data['city'] = City::whereId($request->city_id)->first();
        $data['center'] = Center::whereId($request->center_id)->first();
        $data['course'] = Course::join('city_courses','city_courses.course_id','courses.id')
            ->where('course_id',$request->course_id)
            ->where('city_id',$request->city_id)
            ->select('courses.id','courses.name_en','price_per_week')
            ->first();
        $data['course_weeks'] = $request->no_of_weeks;
        $data['course_cost'] = $request->no_of_weeks * $data['course']->price_per_week;
        $data['start_date'] = $request->start_date;
        $data['accomodation'] = Accomodation::whereId($request->accomodation_id)->first();
        $data['accomodation_weeks'] = $request->accomodation_no_of_weeks;
        $data['accomodation_cost'] = $request->accomodation_no_of_weeks * $data['accomodation']->price_per_week;
        return view('Web.pages.result',compact('data'));

    }

    public function printCalculatePrice(Request $request)
    {
        $data = [];
        $data['country'] = Country::whereId($request->country_id)->first();
        $data['city'] = City::whereId($request->city_id)->first();
        $data['center'] = Center::whereId($request->center_id)->first();
        $data['course'] = Course::join('city_courses','city_courses.course_id','courses.id')
            ->where('course_id',$request->course_id)
            ->where('city_id',$request->city_id)
            ->select('courses.id','courses.name_en','price_per_week')
            ->first();
        $data['course_weeks'] = $request->no_of_weeks;
        $data['course_cost'] = $request->no_of_weeks * $data['course']->price_per_week;
        $data['start_date'] = $request->start_date;
        $data['accomodation'] = Accomodation::whereId($request->accomodation_id)->first();
        $data['accomodation_weeks'] = $request->accomodation_no_of_weeks;
        $data['accomodation_cost'] = $request->accomodation_no_of_weeks * $data['accomodation']->price_per_week;
        return view('Web.pages.print',compact('data'));

    }

    //ajax
    public function getCities(Request $request)
    {
        $cities = City::select('id','name_en')->where('country_id',$request->country_id)->get();
        return response()->json($cities);
    }

    //ajax
    public function getCenters(Request $request)
    {
        $centers = Center::select('id','name_en')->where('city_id',$request->city_id)->get();
        return response()->json($centers);
    }

    //ajax
    public function getCourses(Request $request)
    {
        $courses = Course::join('city_courses','city_courses.course_id','courses.id')
            ->where('city_id',$request->city_id)
            ->select('courses.id','courses.name_en','no_of_weeks')
            ->get();
        return response()->json($courses);
    }

    //ajax
    public function getAccomodations(Request $request)
    {
        $accomodations= Accomodation::select('id','name_en')->where('country_id',$request->country_id)->get();
        return response()->json($accomodations);
    }
}
