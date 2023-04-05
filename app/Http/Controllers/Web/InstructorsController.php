<?php

namespace App\Http\Controllers\web;

use App\Models\City;
use App\Models\User;
use App\Models\Stage;
use App\Models\Course;
use App\Models\Category;
use App\Models\CourseCity;
use App\Models\TeacherInfo;
use Illuminate\Http\Request;
use App\Models\TeacherApppintment;
use App\Http\Controllers\Controller;

class InstructorsController extends Controller
{
    public function index()
    {
        $instractors = TeacherInfo::select('id', 'full_name', 'teacher_id', 'categoey_id','inquiry_cost_normal','inquiry_cost_urgent')
            ->with(['category' => function ($query) {
            $query->select('id','title_' . getLang() . '  as title');
        }])->get();
        $data['categories'] = Category::select('id', 'title_' . getLang() . '  as title')->withCount(['courses'])->get();
        $data['cities'] = City::select('id', 'title_' . getLang() . '  as title')->get();
        $data['stages'] = Stage::select('id', 'title_' . getLang() . '  as title')->get();
        return view('Web.pages.instructors', compact('instractors', 'data'));
    }

    public function instructorDetails(Request $request)
    {
        $teacher_details = User::findOrFail($request->instructor_id);
        $teacher_apppintments = TeacherApppintment::where('teacher_id' , $request->instructor_id)
        ->get();
        //dd($teacher_apppintments);
        return view('Web.pages.instructor_details', compact('teacher_details','teacher_apppintments'));
    }

    public function instructorFilter(Request $request)
    {

        $gender = $request->gender;
        $qualification = $request->qualification;
        $category = $request->category;
        $city = $request->city;
        $learn_type = $request->learn_type;
        $instructor_name_id = $request->instructor_name_id;
        $subject_name_id = $request->subject_name_id;
        $stage_name_id = $request->stage_name_id;


        $instractors = TeacherInfo::where(function ($q) use($gender,$qualification,$category,$city,$learn_type,$instructor_name_id,$subject_name_id,$stage_name_id ){
            if (isset($qualification) && !empty($qualification)) {
                $qualificationArr = explode(',', $qualification);
                $q->whereIn('qualifications', $qualificationArr);
            }

            if (isset($gender) && !empty($gender)) {
                $teacher_ids = User::where('gender', $gender)
                    ->where('type', 'teacher')
                    ->pluck('id');
                $q->whereIn('teacher_id', $teacher_ids);
            }

            if (isset($category) && !empty($category)) {
                $categoryArr = explode(',', $category);
                $q->whereIn('categoey_id', $categoryArr);
            }

            if (isset($city) && !empty($city)) {
                $cityArr = explode(',', $city);
                $teacher_ids = CourseCity::whereIn('city_id', $cityArr)->pluck('teacher_id');
                $q->whereIn('teacher_id', $teacher_ids);
            }

            if (isset($learn_type) && !empty($learn_type)) {
                $learn_typeArr = explode(',', $learn_type);
                $q->whereIn('learn_type', $learn_typeArr);
            }

            if (isset($instructor_name_id) && !empty($instructor_name_id)) {
                $q->where('teacher_id', $instructor_name_id);
            }
            if (isset($subject_name_id) && !empty($subject_name_id)) {
                $q->where('categoey_id', $subject_name_id);
            }
            if (isset($stage_name_id) && !empty($stage_name_id)) {

                $teacher_ids = Course::where('stage_id', $stage_name_id)
                    ->pluck('teacher_id');
                $q->whereIn('teacher_id', $teacher_ids);
            }



        })->with('teacher')
        ->with(['category' => function ($query) {
            $query->select('id','title_' . getLang() . '  as title');
        }])
        ->orderBy('id','desc')->get();

        return response()->json($instractors);




        // if (isset($request->cities)) {
        //     $cities = $request->cities;
        //     $teacher_ids = CourseCity::where('city_id', $cities)->pluck('teacher_id');
        //     $city_filter = TeacherInfo::whereIn('teacher_id', $teacher_ids)->get();
        //     return response()->json($city_filter);
        // }



    }


}
