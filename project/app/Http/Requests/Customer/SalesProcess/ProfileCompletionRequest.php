<?php

namespace App\Http\Requests\Customer\SalesProcess;

use App\Rules\NationalCode;
use Illuminate\Foundation\Http\FormRequest;

class ProfileCompletionRequest extends FormRequest
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

        'first_name'=>'sometimes|required|min:2|max:120',
        'last_name'=>'sometimes|required|min:2|max:120',
        'mobile'=>'sometimes|nullable|unique:users,mobile|max:11',
        'email'=>'sometimes|nullable|email|unique:users,email',
        'national_code'=>['sometimes','required','unique:users,national_code',new NationalCode()]

        ];
    }
}
