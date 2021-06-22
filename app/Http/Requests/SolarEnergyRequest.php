<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolarEnergyRequest extends FormRequest
{
    public function rules()
    {
        return [
            'solar_pv' => 'required|numeric|min:0',
            'battery_storage' => 'required|numeric|min:0',
        ];
    }
}
