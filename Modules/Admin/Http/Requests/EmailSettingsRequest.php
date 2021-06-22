<?php

namespace Modules\Admin\Http\Requests;

use App\Traits\Common;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class EmailSettingsRequest extends FormRequest
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
            'email_from_name' => 'required|string',
            'email_from_address' => 'required|email',
            'email_username' => 'required|string',
            'email_password' => 'nullable|string',
            'email_encryption' => 'required|string',
            'email_mailer' => 'required|string',
            'email_server_host' => 'required|string',
            'email_server_port' => 'required|digits_between:1,5', // 0,1,... 65000
        ];
    }

    public function withValidator(Validator $validator)
    {
        !empty($validator->errors()->all())
        ? toastr()->error(Common::convertValidationErrorsToText($validator->errors()->all()))
        : null;

        return $validator->errors()->all();
    }
}
