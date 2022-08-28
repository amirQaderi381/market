<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CopanRequest extends FormRequest
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

            'code' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'amount_type'=>'required|numeric|in:0,1',
            'amount'=>['required',request()->amount_type == 0 ? 'max:100' : '','min:1','numeric'],
            'discount_ceiling'=>'numeric|min:1',
            'type'=>'required|numeric|in:0,1',
            'status'=>'required|numeric|in:0,1',
            'start_date'=>'required|numeric',
            'end_date'=>'required|numeric',
            'user_id'=>'required_if:type,1|exists:users,id|min:1|regex:/^[0-9]+$/u'
        ];
    }

    public function attributes()
    {
        return ['amount'=>'میزان تخفیف'];
    }
}
