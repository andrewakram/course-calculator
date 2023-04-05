<?php

namespace App\Http\Controllers\MainAdmin;

use App\Http\Requests\MainAdmin\Country\CountryCreateRequest;
use App\Http\Requests\MainAdmin\Country\CountryDeleteRequest;
use App\Http\Requests\MainAdmin\Country\CountryIndexRequest;
use App\Http\Requests\MainAdmin\Country\CountryUpdateRequest;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    public function index(CountryIndexRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        return view('MainAdmin.pages.countries.index');
    }

    public function create(CountryIndexRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        return view('MainAdmin.pages.countries.create');
    }

    public function store(CountryCreateRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Country::create($validator);
        session()->flash('success', 'تم الإضافة بنجاح');
        return redirect()->route('admin.countries');
    }

    public function edit(CountryIndexRequest $request,$id)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $row = Country::findOrFail($id);
        if (!$row) {
            session()->flash('error', 'الحقل غير موجود');
            return redirect()->back();
        }
        return view('MainAdmin.pages.countries.edit', compact('row'));
    }

    public function update(CountryUpdateRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $row = Country::findOrFail($request->row_id);

        $row->update([
            'active' => $request->active,
//            'name_ar' => $request->name_ar,
//            'name_en' => $request->name_en,
            'currency_en' => $request->currency_en,
        ]);

        session()->flash('success', 'تم التعديل بنجاح');
        return redirect()->route('admin.countries');
    }

    public function delete(CountryDeleteRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Country::find($request->row_id)->delete();
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
        Country::findOrFail($id)->delete();
        session()->flash('success', 'تم الحذف بنجاح');
        return back();
    }

    public function getData()
    {
        $model = Country::query();

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->addColumn('select',function ($row){
                return '<div class="form-check form-check-sm form-check-custom form-check-solid me-3 ">
                    <input class="form-check-input checkboxes" type="checkbox"  value="'.$row->id.'" />
                </div>';
            })
//            ->editColumn('image', function ($row) {
//                return '<a class="symbol symbol-50px"><span class="symbol-label" style="background-image:url(' . $row->image . ');"></span></a>';
//            })
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->translatedFormat("Y-m-d (H:i) A");
            })
            ->editColumn('active', function ($row) {
                if($row->active == 1)
                    return "<b class='badge badge-success'>مفعل</b>";
                else
                    return "<b class='badge badge-danger'>غير مفعل</b>";
            })
            ->addColumn('actions', function ($row) {
                $buttons = '';
                $buttons .= '<a href="' . route('admin.countries.edit', [$row->id]) . '" class="btn btn-primary btn-circle btn-sm m-1" title="تعديل">
                            <i class="fa fa-edit"></i>
                        </a>';
//                $buttons .= '<a class="btn btn-danger btn-sm delete btn-circle m-1" data-id="' . $row->id . '"  title="حذف">
//                            <i class="fa fa-trash"></i>
//                        </a>';
//                }
                return $buttons;
            })
            ->rawColumns(['actions','select','created_at','active'])
            ->make();
    }

}
