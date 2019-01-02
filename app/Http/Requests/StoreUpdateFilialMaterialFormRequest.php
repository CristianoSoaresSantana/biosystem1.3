<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateFilialMaterialFormRequest extends FormRequest
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
            'material_sku' => "required",
            'min' => "required",
            'max' => "required",
            'curvaABC' => "required",
            'comissao' => "required",
            'valor_venda' => "required",
            'status' => "required",
        ];
    }
}
