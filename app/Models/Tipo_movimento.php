<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Venda;
use App\Models\Compra;

class Tipo_movimento extends Model
{
    use Notifiable;
    
    public $timestamps = true;

    protected $table = 'tipo_movimentos';
    protected $fillable = ['tipo_movimentacao'];


    /**
     * retorna dados da tabela, com ou sem paramentros.
     * if verifica se existe paramentro de busca.
     */
    public function getResults($tipo_movimentacao = null)
    {
        if(!$tipo_movimentacao)
        {
            return $this->get();
        }
        else
        {
            return $this->where('tipo_movimentacao', 'LIKE', "%{$tipo_movimentacao}%")->get();
        }
    }

    /**
     * relacionamento 1:M, pois uma tipo_movimentacao é caracteristica de muitos
     * vendas e compras e um venda ou compra só pode ter um tipo_movimentacao.
     */
    public function vendas()
    {
        return $this->hasMany(Venda::class, 'tipo_mov_id');
    }

    /**
     * relacionamento 1:M, pois uma tipo_movimentacao é caracteristica de muitos
     * vendas e compras e um venda ou compra só pode ter um tipo_movimentacao.
     */
    public function compras()
    {
        return $this->hasMany(Compra::class, 'tipo_mov_id');
    }
}
