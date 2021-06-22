<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;

class LegalPagesRequest extends FormRequest
{
    public function rules()
    {

        foreach (config('translatable.locales') as $locale) {
            $rules['term_of_use_' . $locale] = 'nullable|string';
            $rules['privacy_policy_' . $locale] = 'nullable|string';
        }
        return $rules;
    }
    public function authorize()
    {
        return true;
    }
}
