<?php

namespace App\Http\Requests\MainAdmin\Center;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CenterUpdateRequest extends FormRequest
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
            'row_id' => 'required|exists:centers,id',
            'country_id' => 'required',
            'city_id' => 'required',
            'active' => 'required|in:0,1',
            'name_en' => 'required',
        ];
    }
}
