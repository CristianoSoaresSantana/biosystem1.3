<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\User;

class Setor extends Model
{
    use Notifiable;
    use SoftDeletes;
    public $timestamps = true;

    protected $dates = ['deleted_at'];
    protected $table = 'setors';
    protected $fillable = ['setor'];

    /**
     * retorna dados da tabela, com ou sem paramentros.
     * if verifica se existe paramentro de busca.
     */
    public function getResults($setor = null)
    {
        if(!$setor)
        {
            return $this->get();
        }
        else
        {
            return $this->where('setor', 'LIKE', "%{$setor}%")->get();
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
}
