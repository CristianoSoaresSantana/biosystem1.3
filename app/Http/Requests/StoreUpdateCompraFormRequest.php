<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCompraFormRequest extends FormRequest
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
            'num_doc'       => "required|unique:compras,num_doc,{$this->segment(3)},num_doc",
            'valor_nota'    => 'required',
            'filial_id'     => 'required|exists:filials,id',
            'fornecedor_id' => 'required|exists:fornecedors,id',
            'tipo_mov_id'   => 'required|exists:tipo_movimentos,id',
        ];
    }
}
