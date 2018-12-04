<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use App\Models\Compra;
use App\Models\Venda;

class Filial extends Model
{
    use Notifiable;
    use SoftDeletes;
    public $timestamps = true;

    protected $dates = ['deleted_at'];
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

    /**
     * relacionamento 1:M, pois uma forma é caracteristica de muitos
     * materiais e um material só pode ter uma forma.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }


    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }

    /**
     * relacionamento N:M, pois uma filial vende muitos
     * materiais e um material é vendo por varias filias.
     */
}
