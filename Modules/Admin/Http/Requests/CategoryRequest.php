<?php

namespace Modules\Admin\Http\Requests;

use App\Traits\Common;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Category;


class CategoryRequest extends FormRequest
{

    public function rules()
    {
      /*$amount = $this->amount;
      $id_amount=Category::where('amount',$amount)->pluck('id')->first();
      $price = $this->price;
      $id_price=Category::where('price',$price)->pluck('id')->first();
      dd($id_amount,$id_price);*/
      return [
          'amount' => 'required|integer|unique:categories,amount,' . $this->id,
          'price' => 'required|integer|unique:categories,price,' . $this->id,

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
