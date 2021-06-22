<?php

namespace Modules\Admin\Http\Requests;

use App\Traits\Common;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class HowItWorksKeyFeaturesRequest extends FormRequest
{

    public function rules()
    {
        $rules = [
            'image' => 'nullable|file|mimes:svg|max:2000|dimensions:width=96,height=96',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.title'] = 'required|string';
            $rules[$locale . '.summary'] = 'nullable|string';
        }

        return $rules;
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
