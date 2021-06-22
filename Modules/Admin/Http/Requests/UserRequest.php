<?php

namespace Modules\Admin\Http\Requests;

use App\Traits\Common;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:191',
            'email' => [
                'required','email','max:255',
                Rule::unique('users', 'email')->ignore($this->user)
            ],
            'mobile' => [
                'nullable','regex:/^\+[1-9]\d*$/',
                Rule::unique('users', 'mobile')->ignore($this->user)
            ],
            'password' => 'sometimes|required',
            'avatar' => 'nullable|file|mimes:png,jpg,jpeg|max:2000', 
        ];
    }

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
