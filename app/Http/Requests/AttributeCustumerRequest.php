<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Custom request, pass the attributes one chooses
 *
 */
class AttributeCustumerRequest extends FormRequest
{
    /**
     * Determine values fot the attributes.
     *
     */
    private const attributes = ['name', 'last_name', 'phone_number', 'state', 'concessionaire_id'];


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
            'attribute' => 'required | in:' . implode(',', self::attributes),
            'value' => 'required',
        ];
    }
}
