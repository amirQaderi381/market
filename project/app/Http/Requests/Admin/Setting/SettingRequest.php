<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'title'=>'required|min:2|max:120|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'description'=>'required|min:5|max:500|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'keywords'=>'required|min:2|max:120|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'logo'=>'image|mimes:png,jpg,jpeg,gif',
            'icon'=>'image|mimes:png,jpg,jpeg,gif',
        ];
    }
}
