<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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

            'name'=>'required|min:2|max:120',
            'description'=>'required|min:2|max:200',
        ];
    }

    public function attributes()
    {
        return [

            'name'=>'عنوان دسترسی'
        ];
    }
}
