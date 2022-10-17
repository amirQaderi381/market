<?php

namespace App\Http\Requests\Customer\Profile;

use App\Rules\NationalCode;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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

            'first_name'=>'nullable|min:2|max:120',
            'last_name'=>'nullable|min:2|max:120',
            'national_code' => ['sometimes', 'required', new NationalCode(), Rule::unique('users')->ignore($this->user()->national_code, 'national_code')]
        ];
    }
}
