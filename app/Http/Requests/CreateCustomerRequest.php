<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
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
            'name' => 'required | max:60 ',
            'last_name' => 'required | max:60 ',
            'phone_number' => 'required | numeric',
            'state' => 'required   | numeric',
            'birth_date' => 'required | date ',
            'address' => 'required | max:120 ',
            'concessionaire_id' => 'required  | numeric',
            'district_id' => 'required | numeric',
        ];
    }
}
