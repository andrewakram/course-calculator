<?php

namespace App\Http\Controllers\MainAdmin;

use App\Http\Requests\MainAdmin\City\CityCreateRequest;
use App\Http\Requests\MainAdmin\City\CityDeleteRequest;
use App\Http\Requests\MainAdmin\City\CityIndexRequest;
use App\Http\Requests\MainAdmin\City\CityUpdateRequest;
use App\Models\City;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    public function index(CityIndexRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        return view('MainAdmin.pages.cities.index');
    }

    public function create(CityIndexRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $countries = Country::get();
        return view('MainAdmin.pages.cities.create',compact('countries'));
    }

    public function store(CityCreateRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        City::create($validator);
        session()->flash('success', 'تم الإضافة بنجاح');
        return redirect()->route('admin.cities');
    }

    public function edit(CityIndexRequest $request,$id)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $row = City::findOrFail($id);
        if (!$row) {
            session()->flash('error', 'الحقل غير موجود');
            return redirect()->back();
        }
        $countries = Country::get();
        return view('MainAdmin.pages.cities.edit', compact('row','countries'));
    }

    public function update(CityUpdateRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $row = City::findOrFail($request->row_id);

        $row->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'country_id' => $request->country_id,
        ]);

        session()->flash('success', 'تم التعديل بنجاح');
        return redirect()->route('admin.cities');
    }

    public function delete(CityDeleteRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        City::find($request->row_id)->delete();
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
        City::findOrFail($id)->delete();
        session()->flash('success', 'تم الحذف بنجاح');
        return back();
    }

    public function getData()
    {
        $model = City::query();

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->translatedFormat("Y-m-d (H:i) A");
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
                $buttons .= '<a href="' . route('admin.cities.edit', [$row->id]) . '" class="btn btn-primary btn-circle btn-sm m-1" title="تعديل">
                            <i class="fa fa-edit"></i>
                        </a>';
                $buttons .= '<a class="btn btn-danger btn-sm delete btn-circle m-1" data-id="' . $row->id . '"  title="حذف">
                            <i class="fa fa-trash"></i>
                        </a>';
//                }
                return $buttons;
            })
            ->rawColumns(['actions','select', 'created_at','country_name','active'])
            ->make();

    }
}
