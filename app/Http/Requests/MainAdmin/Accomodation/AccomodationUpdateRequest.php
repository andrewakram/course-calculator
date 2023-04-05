<?php

namespace App\Http\Requests\MainAdmin\Accomodation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccomodationUpdateRequest extends FormRequest
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
            'row_id' => 'required|exists:accomodations,id',
            'country_id' => 'required',
//            'city_id' => 'required',
            'price_per_week' => 'required',
            'name_en' => 'required',
        ];
    }
}
