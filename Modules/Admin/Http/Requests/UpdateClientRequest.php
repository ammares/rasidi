<?php

namespace Modules\Admin\Http\Requests;

use App\Traits\Common;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'mobile' => 'required|regex:/^\+[1-9]\d*$/|unique:clients,mobile,' . $this->client->id,
            'email' => 'required|unique:clients,email,' . $this->client->id,
            'latitude' => 'sometimes|required|numeric|min:-90|max:90',
            'longitude' => 'sometimes|required|numeric|min:-180|max:180',
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

    public function withValidator(Validator $validator)
    {
        !empty($validator->errors()->all())
        ? toastr()->error(Common::convertValidationErrorsToText($validator->errors()->all()))
        : null;

        return $validator->errors()->all();
    }
}
