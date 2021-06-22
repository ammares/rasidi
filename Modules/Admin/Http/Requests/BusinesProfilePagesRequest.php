<?php

namespace Modules\Admin\Http\Requests;
use App\Traits\Common;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BusinesProfilePagesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'business_logo' => [
                'nullable',
                'file',
                'mimes:jpeg,png,jpg,tif,tiff,webp',
                'max:2000',
                'dimensions:min_width=96,min_height=96',
            ],
            'business_name' => 'nullable|string',
            'business_email' => ['nullable', 'regex:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/'],
            'business_phone' => 'nullable|string',
            'business_facebook' => 'nullable|string',
            'business_linkedin' => 'nullable|string',
            'business_twitter' => 'nullable|string',
            'business_instagram' => 'nullable|string',
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
