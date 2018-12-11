<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateClienteFormRequest extends FormRequest
{
    /**
     * Determine if the cliente is authorized to make this request.
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
            'nome'           => 'required|string|max:100',
            'email'          => "required|string|max:100|unique:clientes,email,{$this->segment(3)},id",
            'cpf'            => "required|string|max:15|unique:clientes,cpf,{$this->segment(3)},id",
            'celular'        => "required|string|max:15|unique:clientes,celular,{$this->segment(3)},id",
            'celular_recado' => "required|string|max:15|unique:clientes,celular_recado,{$this->segment(3)},id",
        ];
    }
}
