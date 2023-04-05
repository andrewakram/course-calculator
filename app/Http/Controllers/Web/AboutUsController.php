<?php

namespace App\Http\Controllers\web;

use App\Models\Page;
use App\Models\TeacherInfo;
use App\Models\UserComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AboutUsController extends Controller
{
    public function index()
    {
        $data['user_comments']= UserComment::select('id','title_' . getLang() . '  as title' , 'body_' . getLang() . '  as body'  , 'user_type' )->get();
       
       // $data['about_data']= Page::select('id','title_' . getLang() . '  as title' , 'body_' . getLang() . '  as body' , 'image'  )->where('type' ,'about')->first();

       //show data for about us section
         $data['about_data'] = Page::get();

         $data['about_title_arabic'] = $data['about_data']->where('type' ,'about')->first()->title_ar ;
         $data['about_title_english'] = $data['about_data']->where('type' ,'about')->first()->title_en ;
         $data['about_body_arabic'] = $data['about_data']->where('type' ,'about')->first()->body_ar ;
		 $data['about_body_english'] = $data['about_data']->where('type' ,'about')->first()->body_en ;
         $data['about_image'] = $data['about_data']->where('type' ,'about')->first()->image ;

        //show data for Our vision section
         $data['vision_title_arabic'] = $data['about_data']->where('type' ,'our_values')->first()->title_ar ;
         $data['vision_title_english'] = $data['about_data']->where('type' ,'our_values')->first()->title_en ;
         $data['vision_body_arabic'] = $data['about_data']->where('type' ,'our_values')->first()->body_ar ;
		 $data['vision_body_english'] = $data['about_data']->where('type' ,'our_values')->first()->body_en ;
        

        //show data for Our Message section
         $data['Message_title_arabic'] = $data['about_data']->where('type' ,'our_story')->first()->title_ar ;
         $data['Message_title_english'] = $data['about_data']->where('type' ,'our_story')->first()->title_en ;
         $data['Message_body_arabic'] = $data['about_data']->where('type' ,'our_story')->first()->body_ar ;
		 $data['Message_body_english'] = $data['about_data']->where('type' ,'our_story')->first()->body_en ;
       


        $data['popular_teachers'] =  TeacherInfo::inRandomOrder()->limit(6)->get();
						
         

    
        return view('Web.pages.about_us' , compact('data'));
    }
}
