<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateFilialFormRequest extends FormRequest
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
     * No cnpj eu pego o id do registro para verificar se o dados a ser editado já existe.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'razao_social'  => 'required',
            'cnpj'          => "required|unique:filials,cnpj,{$this->id},id",
        ];
    }
}
