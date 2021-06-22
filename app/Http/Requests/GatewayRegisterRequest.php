<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GatewayRegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'serial_number' => 'required|string',
        ];
    }
}
