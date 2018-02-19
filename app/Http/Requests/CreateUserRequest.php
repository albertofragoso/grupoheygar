<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'email' => 'required'
        ];
    }

    public function messages()
    {
        return [
          'name.required' => 'Ingresa nombre del cliente',
          'address.required' => 'Ingresa dirección del cliente',
          'email.required' => 'Ingresa email del cliente',
        ];
    }
}
