<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Setor;
use App\Models\Filial;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'filial_id', 'setor_id', 'cpf', 'data_nascimento', 'celular',
        'celular_recado', 'status', 'permissao', 'endereco',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * relacionamento 1:M, pois uma forma é caracteristica de muitos
     * materiais e um material só pode ter uma forma.
     */
    public function setor()
    {
        return $this->belongsTo(Setor::class);
    }

    public function filial()
    {
        return $this->belongsTo(Filial::class);
    }

    /**
     * Neste metodo, eu busco os dados paginando, por parametro ou sem parametro!
     * Se for informado um filter, este metodo faz uma busca hibrida,  senão ele
     * verifica qual parametro veio.
     */
    public function getResults($data, $itensPage)
    {
        if (!isset($data['filter']) && !isset($data['name'])) {
            return $this->paginate($itensPage);
        }
        else
        {
            return $this->where(function ($query) use ($data){
                        if(isset($data['filter'])) 
                        {
                            $filter = $data['filter'];
                            $query->where('name', 'LIKE', "%{$filter}%");
                        }

                        if(isset($data['name']))
                        {
                            $filter = $data['name'];
                            $query->where('name', 'LIKE', "%{$filter}%");
                        }
                    })->paginate($itensPage); //toSQL(); para vê como esta acontecendo por traz de query
        }
        
    }
}
