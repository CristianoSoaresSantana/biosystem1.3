<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use App\Models\Filial;
use App\Models\Tipo_movimento;
use App\Models\Cliente;
use App\Models\Forma_pagto;
use App\Models\Material;

class Venda extends Model
{
    use SoftDeletes;
    use Notifiable;

    public $timestamps = true;
    
    protected $dates = ['deleted_at'];
    protected $table = 'vendas';
    protected $fillable = ['cliente_id', 'filial_id', 'tipo_mov_id', 'user_id', 'valor_total', 'status'];
    


    /**
     **************** Neste metodo, eu busco os dados paginando, por parametro ou sem parametro! ****************
     **************** Se for informado um filter, este metodo faz uma busca hibrida,  senão ele  ****************
     **************** verifica qual parametro veio.                                              ****************
     */
    public function getResults($data, $itensPage)
    {
        if (!isset($data['filter']) && !isset($data['id']) && !isset($data['created_at'])) {
            return $this->paginate($itensPage);
        }
        else
        {
            return $this->where(function ($query) use ($data){
                        if(isset($data['filter'])) 
                        {
                            $filter = $data['filter'];
                            $query->where('id', 'LIKE', "%{$filter}%");
                            $query->orWhere('created_at', 'LIKE', "%{$filter}%");
                        }

                        if(isset($data['id']))
                        {
                            $filter = $data['id'];
                            $query->where('id', 'LIKE', "%{$filter}%");
                        }

                        if(isset($data['created_at']))
                        {
                            $filter = $data['created_at'];
                            $query->where('created_at', 'LIKE', "%{$filter}%");
                        }
                    })->paginate($itensPage); //toSQL(); para vê como esta acontecendo por traz de query
        }
        
    }

    /**
     ****************************************** relacionamento 1:M  *************************************
     ************************** Está classe tem um para muitos relacionamentos! *************************
     */
    public function filial()
    {
        return $this->belongsTo(Filial::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function tipoMovimento()
    {
        return $this->belongsTo(Tipo_movimento::class);
    }

    /**
     ************************* relacionamento N:M, pois uma forma_pagamento é caracteristica *************************
     ************************* de muitos vendas venda pode ter varias forma_pagamentos       *************************
     */
    public function formaPagtos()
    {
        return $this->belongsToMany(Forma_pagto::class, 'forma_pagto_vendas')->withPivot('valor');
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'material_vendas')
                    ->withPivot('quantidade', 'lote', 'valor_unitario', 'valor_com_desconto', 'desconto', 'justificativa_desconto', 'created_at', 'updated_at');
    }
}
