<?php

namespace App\Http\Requests\MainAdmin\CityCourse;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityCourseUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::guard('admin')->user())
            return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'row_id' => 'required|exists:city_courses,id',
            'course_id' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'no_of_weeks' => 'required',
            'price_per_week' => 'required',
        ];
    }
}
