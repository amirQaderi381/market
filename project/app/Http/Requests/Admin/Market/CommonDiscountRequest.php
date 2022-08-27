<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CommonDiscountRequest extends FormRequest
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
            'percentage'=>'required|min:1|max:100|numeric',
            'discount_ceiling'=>'required|numeric',
            'minimal_order_amount'=>'required|numeric',
            'minimal_order_amount'=>'required|numeric',
            'start_date'=>'required|numeric',
            'end_date'=>'required|numeric',
            'status'=>'required|in:0,1'
        ];

    }
}
