<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EnergyConsumptionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'provider_id' => 'nullable|exists:providers,id',
            'provider_name' => 'nullable|string',
            'devices' => 'required|array',
            'devices.*.id' => [
                'required',
                'numeric',
                'distinct',
                Rule::exists('devices')->where(function ($query) {
                    $query->where('enabled', 1);
                })
            ],
            'devices.*.label' => 'required|string',
            'devices.*.power' => 'nullable|numeric|min:0',
            'devices.*.temperature' => 'nullable|numeric',
        ];
    }
}
