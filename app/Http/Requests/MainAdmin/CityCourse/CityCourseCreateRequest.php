<?php

namespace App\Http\Requests\MainAdmin\CityCourse;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CityCourseCreateRequest extends FormRequest
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
    public function rules()
    {
        return [
//            'name_ar' => 'required',
            'course_id' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'no_of_weeks' => 'required',
            'price_per_week' => 'required',
        ];
    }
}
