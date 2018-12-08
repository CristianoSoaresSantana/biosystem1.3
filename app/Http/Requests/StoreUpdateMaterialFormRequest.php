<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateMaterialFormRequest extends FormRequest
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
            'sku'                   => "required|unique:materials,sku,{$this->segment(3)},sku",
            'cod_barra'             => "required|unique:materials,cod_barra,{$this->segment(3)},sku",
            'descricao'             => 'required',
            'tipo_material_id'      => 'required|exists:tipo_materials,id',
            'forma_farmaceutica_id' => 'required|exists:forma_farmaceuticas,id',
            'valor_compra'          => 'required',
            'valor_revenda'         => 'required',
            'image'                 => 'image',
        ];
    }
}
