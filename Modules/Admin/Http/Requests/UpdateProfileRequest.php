<?php

namespace Modules\Admin\Http\Requests;

use App\Traits\Common;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $unique_rule = isset($this->user)
            ? '|unique:users,mobile,'.$this->user()->id
            : '';

        return [
            'name' => 'required|max:191',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user()->id,
            'mobile' => 'nullable|regex:/^\+[1-9]\d*$/'.$unique_rule,
            'avatar' => 'nullable|file|max:2000|image',
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
