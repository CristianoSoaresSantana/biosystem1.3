<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Cliente extends Model
{
    use Notifiable;
    use SoftDeletes;
    public $timestamps = true;

    protected $dates = ['deleted_at'];
    protected $table = 'clientes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'email', 'cpf', 'celular', 'celular_recado', 'endereco',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Neste metodo, eu busco os dados paginando, por parametro ou sem parametro!
     * Se for informado um filter, este metodo faz uma busca hibrida,  senão ele
     * verifica qual parametro veio.
     */
    public function getResults($data, $itensPage)
    {
        if (!isset($data['filter']) && !isset($data['nome'])) {
            return $this->paginate($itensPage);
        }
        else
        {
            return $this->where(function ($query) use ($data){
                        if(isset($data['filter'])) 
                        {
                            $filter = $data['filter'];
                            $query->where('nome', 'LIKE', "%{$filter}%");
                        }

                        if(isset($data['nome']))
                        {
                            $filter = $data['nome'];
                            $query->where('nome', 'LIKE', "%{$filter}%");
                        }
                    })->paginate($itensPage); //toSQL(); para vê como esta acontecendo por traz de query
        }
        
    }
}
