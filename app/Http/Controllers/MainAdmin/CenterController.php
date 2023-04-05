<?php

namespace App\Http\Controllers\MainAdmin;

use App\Http\Requests\MainAdmin\Center\CenterCreateRequest;
use App\Http\Requests\MainAdmin\Center\CenterDeleteRequest;
use App\Http\Requests\MainAdmin\Center\CenterIndexRequest;
use App\Http\Requests\MainAdmin\Center\CenterUpdateRequest;
use App\Models\City;
use App\Models\Center;
use App\Models\Country;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;

class CenterController extends Controller
{
    public function index(CenterIndexRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        return view('MainAdmin.pages.centers.index');
    }

    public function create(CenterIndexRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $countries = Country::get();
        return view('MainAdmin.pages.centers.create',compact('countries'));
    }

    public function store(CenterCreateRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Center::create($validator);
        session()->flash('success', 'تم الإضافة بنجاح');
        return redirect()->route('admin.centers');
    }

    public function edit(CenterIndexRequest $request,$id)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $row = Center::findOrFail($id);
        if (!$row) {
            session()->flash('error', 'الحقل غير موجود');
            return redirect()->back();
        }
        $cities = City::where('country_id',$row->country_id)->get();
        $countries = Country::get();
        return view('MainAdmin.pages.centers.edit', compact('row','countries','cities'));
    }

    public function update(CenterUpdateRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $row = Center::findOrFail($request->row_id);

        $row->update([
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'name_en' => $request->name_en,
            'active' => $request->active,
        ]);

        session()->flash('success', 'تم التعديل بنجاح');
        return redirect()->route('admin.centers');
    }

    public function delete(CenterDeleteRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Center::find($request->row_id)->delete();
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
        Center::findOrFail($id)->delete();
        session()->flash('success', 'تم الحذف بنجاح');
        return back();
    }

    public function getData()
    {
        $model = Center::query();

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->translatedFormat("Y-m-d (H:i) A");
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
            ->editColumn('active', function ($row) {
                if($row->active == 1)
                    return "<b class='badge badge-success'>مفعل</b>";
                else
                    return "<b class='badge badge-danger'>غير مفعل</b>";
            })

            ->addColumn('select',function ($row){
                return '<div class="form-check form-check-sm form-check-custom form-check-solid me-3 ">
                    <input class="form-check-input checkboxes" type="checkbox"  value="'.$row->id.'" />
                </div>';
            })
            ->addColumn('actions', function ($row) {
                $buttons = '';
                $buttons .= '<a href="' . route('admin.centers.edit', [$row->id]) . '" class="btn btn-primary btn-circle btn-sm m-1" title="تعديل">
                            <i class="fa fa-edit"></i>
                        </a>';
                $buttons .= '<a class="btn btn-danger btn-sm delete btn-circle m-1" data-id="' . $row->id . '"  title="حذف">
                            <i class="fa fa-trash"></i>
                        </a>';
//                }
                return $buttons;
            })
            ->rawColumns(['actions','select', 'created_at','country_name','city_name','active'])
            ->make();

    }

}
