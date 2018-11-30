<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{
    protected $table = 'filials';
    protected $fillable = ['razao_social', 'cnpj'];

    /**
     * retorna dados da tabela, com ou sem paramentros.
     * if verifica se existe paramentro de busca.
     */
    public function getResults($razao_social = null)
    {
        if(!$razao_social)
        {
            return $this->get();
        }
        else
        {
            return $this->where('razao_social', 'LIKE', "%{$razao_social}%")->get();
        }
    }
}
