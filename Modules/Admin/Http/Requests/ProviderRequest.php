<?php

namespace Modules\Admin\Http\Requests;

use App\Traits\Common;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'country_id' => 'required|required_with:countries.*.id',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.name'] = 'required|string|max:50';
        }

        return $rules;
    }

    public function withValidator(Validator $validator)
    {
        !empty($validator->errors()->all())
            ? toastr()->error(Common::convertValidationErrorsToText($validator->errors()->all()))
            : null;

        return $validator->errors()->all();
    }
    public function attributes()
    {
        return [
            'en.name' => 'Provider Name (EN)',
            'es.name' => 'Provider Name (ES)',
            'country_id' => 'Country'
        ];
    }
}
