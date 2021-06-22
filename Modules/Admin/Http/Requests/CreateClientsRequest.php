<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Traits\Common;
use Illuminate\Contracts\Validation\Validator;
class CreateClientsRequest extends FormRequest
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
            'mobile' => 'required|regex:/^\+[1-9]\d*$/|unique:clients,mobile',
            'email' => 'required|unique:clients,email',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
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
