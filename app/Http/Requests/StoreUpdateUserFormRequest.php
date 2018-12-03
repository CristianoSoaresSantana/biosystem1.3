<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUserFormRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'email' => "required|string|max:100|unique:users,email,{$this->segment(3)},id",
            'cpf' => "required|string|max:15|unique:users,cpf,{$this->segment(3)},id",
            'password' => 'required|string|min:6',
            'filial_id' => 'required|exists:filials,id',
            'setor_id' => 'required|exists:setors,id',
            'data_nascimento' => 'required|date|date_format:Y-m-d',
            'celular' => "required|string|max:15|unique:users,celular,{$this->segment(3)},id",
            'celular_recado' => "required|string|max:15|unique:users,celular_recado,{$this->segment(3)},id",
        ];
    }
}