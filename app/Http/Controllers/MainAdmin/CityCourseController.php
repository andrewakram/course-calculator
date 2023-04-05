<?php

namespace App\Http\Controllers\MainAdmin;

use App\Http\Requests\MainAdmin\CityCourse\CityCourseCreateRequest;
use App\Http\Requests\MainAdmin\CityCourse\CityCourseDeleteRequest;
use App\Http\Requests\MainAdmin\CityCourse\CityCourseIndexRequest;
use App\Http\Requests\MainAdmin\CityCourse\CityCourseUpdateRequest;
use App\Models\City;
use App\Models\CityCourse;
use App\Models\Country;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;

class CityCourseController extends Controller
{
    public function index(CityCourseIndexRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        return view('MainAdmin.pages.cities_courses.index');
    }

    public function create(CityCourseIndexRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $countries = Country::get();
        $courses = Course::get();
        return view('MainAdmin.pages.cities_courses.create',compact('countries','courses'));
    }

    public function store(CityCourseCreateRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        CityCourse::create($validator);
        session()->flash('success', 'تم الإضافة بنجاح');
        return redirect()->route('admin.cities_courses');
    }

    public function edit(CityCourseIndexRequest $request,$id)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $row = CityCourse::findOrFail($id);
        if (!$row) {
            session()->flash('error', 'الحقل غير موجود');
            return redirect()->back();
        }
        $cities = City::where('country_id',$row->country_id)->get();
        $countries = Country::get();
        $courses = Course::get();
        return view('MainAdmin.pages.cities_courses.edit', compact('row','countries','courses','cities'));
    }

    public function update(CityCourseUpdateRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $row = CityCourse::findOrFail($request->row_id);

        $row->update([
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'course_id' => $request->course_id,
            'no_of_weeks' => $request->no_of_weeks,
            'price_per_week' => $request->price_per_week,
        ]);

        session()->flash('success', 'تم التعديل بنجاح');
        return redirect()->route('admin.cities-courses');
    }

    public function delete(CityCourseDeleteRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        CityCourse::find($request->row_id)->delete();
        session()->flash('success', 'تم الحذف بنجاح');
        return response()->json(['message' => 'Success']);
    }

    public function deleteMulti(Request $request)
    {
        $ids_array = explode(',', $request->ids);
        foreach ($ids_array as $id) {
            $delete = $this->destroy($id);
            if (!$delete) {
                session()->flash('success', 'حدث خطأ ما');
                return redirect()->back();
            }
        }
        session()->flash('success', 'تم الحذف بنجاح');
        return redirect()->back();
    }

    public function destroy($id)
    {
        CityCourse::findOrFail($id)->delete();
        session()->flash('success', 'تم الحذف بنجاح');
        return back();
    }

    public function getData()
    {
        $model = CityCourse::query();

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->translatedFormat("Y-m-d (H:i) A");
            })
            ->addColumn('course_name', function ($row) {
                if($row->course_id)
                    return $row->course->name_en;
                else
                    return "-";
            })
            ->addColumn('city_name', function ($row) {
                if($row->city_id)
                    return "<b class='badge badge-dark'>" .$row->city->name_en ."</b>";
                else
                    return "-";
            })
            ->addColumn('country_name', function ($row) {
                if($row->country_id)
                    return "<b class='badge badge-dark'>" .$row->country->name_en ."</b>";
                else
                    return "-";
            })

            ->addColumn('select',function ($row){
                return '<div class="form-check form-check-sm form-check-custom form-check-solid me-3 ">
                    <input class="form-check-input checkboxes" type="checkbox"  value="'.$row->id.'" />
                </div>';
            })
            ->addColumn('actions', function ($row) {
                $buttons = '';
                $buttons .= '<a href="' . route('admin.cities-courses.edit', [$row->id]) . '" class="btn btn-primary btn-circle btn-sm m-1" title="تعديل">
                            <i class="fa fa-edit"></i>
                        </a>';
                $buttons .= '<a class="btn btn-danger btn-sm delete btn-circle m-1" data-id="' . $row->id . '"  title="حذف">
                            <i class="fa fa-trash"></i>
                        </a>';
//                }
                return $buttons;
            })
            ->rawColumns(['actions','select', 'created_at','country_name','city_name','course_name'])
            ->make();

    }

    public function getCities(Request $request)
    {
        $cities = City::select('id','name_en')->where('country_id',$request->country_id)->get();
        return response()->json($cities);
    }
}
