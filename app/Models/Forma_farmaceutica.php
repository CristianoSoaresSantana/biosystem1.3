<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\Material;

class Forma_farmaceutica extends Model
{
    use Notifiable;
    use SoftDeletes;
    
    public $timestamps = true;

    protected $dates = ['deleted_at'];
    protected $table = 'forma_farmaceuticas';
    protected $fillable = ['forma_farm'];


    /**
     * retorna dados da tabela, com ou sem paramentros.
     * if verifica se existe paramentro de busca.
     */
    public function getResults($forma_farm = null)
    {
        if(!$forma_farm)
        {
            return $this->get();
        }
        else
        {
            return $this->where('forma_farm', 'LIKE', "%{$forma_farm}%")->get();
        }
    }

    /**
     * relacionamento 1:M, pois uma forma é caracteristica de muitos
     * materiais e um material só pode ter uma forma.
     */
    public function materials()
    {
        return $this->hasMany(Material::class);
    }
}
