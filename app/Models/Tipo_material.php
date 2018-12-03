<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\Material;

class Tipo_material extends Model
{
    use Notifiable;
    use SoftDeletes;
    
    public $timestamps = true;

    protected $dates = ['deleted_at'];
    protected $table = 'tipo_materials';
    protected $fillable = ['tipo_material'];


    /**
     * retorna dados da tabela, com ou sem paramentros.
     * if verifica se existe paramentro de busca.
     */
    public function getResults($tipo_material = null)
    {
        if(!$tipo_material)
        {
            return $this->get();
        }
        else
        {
            return $this->where('tipo_material', 'LIKE', "%{$tipo_material}%")->get();
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
