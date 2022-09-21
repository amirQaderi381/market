<?php

namespace App\Http\Requests\Customer\SalesProcess;

use App\Rules\PostalCode;
use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
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

            'province_id'=>'required|exists:provinces,id',
            'city_id'=>'required|exists:cities,id',
            'postal_code'=>['required',new PostalCode()],
            'address'=>'required|min:5|max:300',
            'no'=>'required',
            'unit'=>'required',
            'receiver'=>'sometimes',
            'recipient_first_name'=>'required_with:receiver',
            'recipient_last_name'=>'required_with:receiver',
            'mobile'=>'required_with:receiver'

        ];
    }

    public function attributes()
    {
        return [

            'unit'=>'واحد'
        ];
    }
}
