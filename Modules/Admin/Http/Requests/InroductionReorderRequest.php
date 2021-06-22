<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InroductionReorderRequest extends FormRequest
{

    public function rules()
    {
        $rules = [
            'data.*.id' => 'required_with:Introductions.*.id',
            'data.*.order' => 'required',
        ];

        return $rules;
    }

    public function authorize()
    {
        return true;
    }

}
