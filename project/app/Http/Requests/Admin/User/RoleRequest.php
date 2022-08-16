<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $route = Route::current();
        if($route->getName() == 'admin.user.role.store')
        {
            return [
                'name'=>'required|min:2|max:120',
                'description'=>'required|min:2|max:200',
                'permissions.*'=>'exists:permissions,id',
            ];
        }
    }

    public function attributes()
    {
        return [

            'name'=>'عنوان نقش',
            'permissions.*'=>'دسترسی'
        ];
    }
}
