<?php

namespace App\Http\Controllers\web;

use App\Models\Tag;
use App\Models\City;
use App\Models\User;
use App\Models\Stage;
use App\Models\Course;
use App\Models\Category;
use App\Models\CourseCity;
use App\Models\TeacherInfo;
use App\Models\CourseLesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoursesController extends Controller
{
    public function index()
    {
        $data['Courses'] = Course::select('id','teacher_id','title_' . getLang() . '  as title',
         'body_' . getLang() . '  as body',
        'price_before' , 'price_after'
         )->paginate(2);
         $data['instructors_search'] = TeacherInfo::select('id', 'full_name', 'teacher_id', 'categoey_id')->get();
         $data['categories'] =  Category::select('id','title_' . getLang() . '  as title')->withCount(['courses'])->get();
        $data['instructors'] =  User::where('type','teacher')->select('id')->withCount(['courses'])->get();
         $data['cities'] =  City::select('id','title_' . getLang() . '  as title')->get();
         $data['stages'] = Stage::select('id', 'title_' . getLang() . '  as title')->get();
         $data['Courses_search'] = Course::select('id','teacher_id','title_' . getLang() . '  as title',
         'body_' . getLang() . '  as body',
        'price_before' , 'price_after'
         )->get();
        // $data['Courses'] = Course::with('teacher')->get();
        return view('Web.pages.courses',compact('data'));
    }
    public function courseDetails(Request $request)
    {
        $tags =  Tag::select('id','title_' . getLang() . '  as title'   , 'link' )
        ->inRandomOrder()->limit(6)->get();

       

        $myCourse = Course::findOrFail($request->course_id);
        $related_courses = Course::select('id','title_' . getLang() . '  as title' )->where('category_id' , $myCourse->category_id)->get();


        $course_details = Course::findOrFail($request->course_id);
        $title = 'title_' . getLang();
        $body = 'body_' . getLang();

       $CourseLessons = CourseLesson::where('course_id' , $request->course_id)->get();

       $teacher_course_id = $course_details -> teacher_id ;
        $instractor = TeacherInfo::where('teacher_id' , $teacher_course_id )->with('category')->first();  
        return view('Web.pages.course_details' ,compact('course_details' , 'title' ,'body' , 'instractor','CourseLessons' , 'tags' ,'related_courses') );
    }

    public function courseFilter(Request $request)
    {
       
        $categories = $request->categories;
        $cities = $request->cities;
        $instructors = $request->instructors;
        $price_course = $request->price_course;
        $course_name_id = $request->course_name_id;
        $city_selected_id = $request->city_selected_id;
        $instructor_name_id = $request->instructor_name_id;
        $subject_name_id = $request->subject_name_id;
        $stage_name_id = $request->stage_name_id;
        
        
        

        $course_filter = Course::select('id','teacher_id','image','title_' . getLang() . '  as title',
          'body_' . getLang() . '  as body','price_before' , 'price_after' ,'image')
          ->where(function ($q) use($categories,$cities,$instructors,$price_course,$city_selected_id,$course_name_id,$instructor_name_id,$subject_name_id,$stage_name_id){

            if (isset($categories) && !empty($categories)) {
                $categoriesArr = explode(',', $categories);
                $q->whereIn('category_id', $categoriesArr);
            }
            
            
            if (isset($cities) && !empty($cities)) {
                $course_id = CourseCity::whereHas('city', function ($query)use($cities) {
                $query->whereIn('city_id' , explode( ',', $cities )); 
                })->pluck('course_id');
                $q->whereIn('id', $course_id);
            }

            if (isset($instructors) && !empty($instructors)) {
                $instructorsArr = explode(',', $instructors);
                $q->whereIn('teacher_id', $instructorsArr);
            }

            if (isset($city_selected_id) && !empty($city_selected_id)) {
                $course_id = CourseCity::whereHas('city', function ($query)use($city_selected_id) {
                $query->where('city_id' , $city_selected_id); 
                })->select('course_id');
                $q->whereIn('id', $course_id);
            }


            if (isset($price_course) && !empty($price_course)) {
                if($price_course == 1)
                    {         
                        $q->whereNull('price_before'); //free
        
                    }elseif($price_course == 2)
                    {
                        $q->whereNotNull('price_before');//paid
                    }        
            }

            if (isset($course_name_id) && !empty($course_name_id)) {
              $course_name =  $q->where('id', $course_name_id);
            }

            if (isset($instructor_name_id) && !empty($instructor_name_id)) {
                $q->where('teacher_id', $instructor_name_id);
            }

            if (isset($subject_name_id) && !empty($subject_name_id)) {
                $q->where('category_id', $subject_name_id);
            }
            if (isset($stage_name_id) && !empty($stage_name_id)) {
                $q->where('stage_id', $stage_name_id);
            }
            

        })->with(['teacher'=>function($query){
            $query->with('teacherInfo');
           }])
        ->orderBy('id','desc')->get();

      //dd($course_filter);
        return response()->json($course_filter);
        /////


        // if(isset($request->categories)){
        //     $categories =  $request->categories ;
        //     $course_filter = Course::select('id','teacher_id','image','title_' . getLang() . '  as title',
        //     'body_' . getLang() . '  as body',
        //    'price_before' , 'price_after')
        //    ->whereIn('category_id' , explode( ',', $categories ))->with(['teacher'=>function($query){
        //     $query->with('teacherInfo');
        //    }])
        //    ->get();
        //   //  dd($course_filter);
        //   return response()->json($course_filter);
        //    }


          


        //    if(isset($request->cities)){
        //     $cities =  $request->cities ;
        //     $city_filter = CourseCity::whereIn('city_id' , explode( ',', $cities ))
        //     ->with(['course'=>function($query){

        //         $query->with(['teacher'=>function($query2){
        //         $query2->with('teacherInfo');
        //        }])->select('id','teacher_id','image','title_' . getLang() . '  as title',
        //         'body_' . getLang() . '  as body',
        //        'price_before' , 'price_after');
        //        }])
               
            
            
        //     ->get();
            
        //     // $city_filter = CourseCity::whereHas('city', function ($query) {
        //     //     $query->whereIn('city_id' , explode( ',', $cities )); 
        //     // })->get(); 

        //    // dd($city_filter);

        //   return  response()->json($city_filter);
        //    }

        //        if(isset($request->coursename)){
        //         $courseid =  $request->coursename ;
                    
        //         $course_name_filter = Course::select('id','teacher_id','image','title_' . getLang() . '  as title',
        //         'body_' . getLang() . '  as body',
        //         'price_before' , 'price_after')
        //         ->whereIn('id' , explode( ',', $courseid ))->with(['teacher'=>function($query){
        //             $query->with('teacherInfo');
        //         }])
        //         ->get();
        //         //  dd($course_filter);
        //         return response()->json($course_name_filter);
        //  }
            //    if(isset($request->instructors)){
            //     $instructors =  $request->instructors ;
            //     $instructors_filter = Course::select('id','teacher_id','image','title_' . getLang() . '  as title',
            //     'body_' . getLang() . '  as body',
            //    'price_before' , 'price_after')
            //    ->whereIn('teacher_id' , explode( ',', $instructors ))->with(['teacher'=>function($query){
            //     $query->with('teacherInfo');
            //    }])
            //    ->get();
            //   //  dd($course_filter);
            //   return response()->json($instructors_filter);
            //    }

            //    if(isset($request->price_course)){
            //   // dd($request->all());
                
            //     $price_course =  $request->price_course ;
            
            //         $price_filter = Course::select('id','teacher_id','image','title_' . getLang() . '  as title',
            //         'body_' . getLang() . '  as body',
            //         'price_before' , 'price_after')->with(['teacher'=>function($query){
            //         $query->with('teacherInfo');
            //    }])
            //    ->where(function($query3) use ($price_course){
                    //0 free //1 paid //2 all
            //     if($price_course == 0)
            //     {

            //         $query3->whereNull('price_before'); //free
            //        // dd($query3);

            //     }elseif($price_course == 1)
            //     {
            //         $query3->whereNotNull('price_before');//paid
            //     }

            //    })
            //    ->get();

                
            //   return response()->json($price_filter);
            //    }

           
           
    }

}
