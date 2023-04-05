<?php

namespace App\Http\Controllers\web;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogsController extends Controller
{
    public function index()
    {
        $blogs = Blog::select('id','admin_id','title_' . getLang() . '  as title' ,'description_' . getLang() . '  as description')
            ->with('admin')
            ->paginate(3);
        $tags =  Tag::select('id','title_' . getLang() . '  as title'   , 'link' )
            ->inRandomOrder()
            ->limit(6)
            ->get();

        $recent_posts = Blog::select('id','admin_id','title_' . getLang() . '  as title' ,'description_' . getLang() . '  as description')
            ->inRandomOrder()
            ->limit(4)
            ->get();

        $data['categories'] =  Category::select('id','title_' . getLang() . '  as title')
            ->withCount(['courses'])
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return view('Web.pages.blogs' , compact('blogs' , 'tags' , 'data' , 'recent_posts' ));
    }
    public function blogDetails(Request $request)
    {
//        return redirect(route('admin.home'));
        $blog_details = Blog::findOrFail($request->blog_id);
        $title = 'title_' . getLang();
        $description = 'description_' . getLang();
        $tags =  Tag::select('id','title_' . getLang() . '  as title'   , 'link' )
            ->inRandomOrder()
            ->limit(6)
            ->get();

        $recent_posts = Blog::select('id','admin_id','title_' . getLang() . '  as title' ,'description_' . getLang() . '  as description')
            ->inRandomOrder()
            ->limit(4)
            ->get();

        $data['categories'] =  Category::select('id','title_' . getLang() . '  as title')
            ->withCount(['courses'])
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return view('Web.pages.blog_details',compact('blog_details', 'title' , 'description', 'tags' , 'data' , 'recent_posts'));
    }
}
