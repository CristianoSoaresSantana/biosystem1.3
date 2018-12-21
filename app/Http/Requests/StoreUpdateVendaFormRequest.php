<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateVendaFormRequest extends FormRequest
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
            'user_id'     => 'required|exists:users,id',
            'filial_id'   => 'required|exists:filials,id',
            'cliente_id'  => 'required|exists:clientes,id',
            'tipo_mov_id' => 'required|exists:tipo_movimentos,id',
            // 'valor_total' => 'required',
        ];
    }
}
