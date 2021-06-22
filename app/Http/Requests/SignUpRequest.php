<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
            'mobile_number' => 'required|regex:/^\+[1-9]\d*$/|unique:users,mobile_number',
            'phone_number' => 'required|string',
            'national_num' => 'required|string',
            'address' => 'required|address',
            'online' => 'required|in:0,1',
            'balance' => 'nullable|integer'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
