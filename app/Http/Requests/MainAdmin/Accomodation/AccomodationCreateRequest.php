<?php

namespace App\Http\Requests\MainAdmin\Accomodation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AccomodationCreateRequest extends FormRequest
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
            'name_en' => 'required',
            'country_id' => 'required',
//            'city_id' => 'required',
            'price_per_week' => 'required',
        ];
    }
}
