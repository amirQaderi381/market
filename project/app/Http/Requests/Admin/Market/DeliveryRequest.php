<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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

            'name'=>'required|min:2|max:120|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'amount' => 'required|regex:/^[0-9.]+$/u',
            'delivery_time'=>'required|integer',
            'delivery_time_unit'=>'required|regex:/^[ا-یa-zA-Z-ء-ي., ]+$/u'
        ];
    }

    public function attributes()
    {
        return ['name'=>'نام روش ارسال'];
    }
}
