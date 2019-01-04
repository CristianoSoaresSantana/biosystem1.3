<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\Filial;

class Filial_material extends Model
{
    use SoftDeletes;
    use Notifiable;

    public $timestamps = true;
    public $incrementing = false;

    protected $dates = ['deleted_at'];
    protected $table = 'filial_materials';
    protected $fillable = ['filial_id', 'material_sku', 'quantidade', 'min', 'max', 'curvaABC', 'comissao', 'valor_venda', 'status'];

    public function getResults($data, $itensPage)
    {
        if (!isset($data['cod_barra']) && !isset($data['material_sku']) && !isset($data['descricao'])) {
            return Filial::find($data['filial_id'])->materials()->paginate($itensPage)->toArray();
        }
        elseif(isset($data['cod_barra'])){
            $filial = Filial::find($data['filial_id']);
            return $filial->materials()->where('cod_barra', $data['cod_barra'])->paginate($itensPage)->toArray();
        }
        elseif(isset($data['material_sku'])){
            $filial = Filial::find($data['filial_id']);
            return $filial->materials()->where('sku', $data['material_sku'])->paginate($itensPage)->toArray();
        }
        elseif(isset($data['descricao'])){
            $filial = Filial::find($data['filial_id']);
            return $filial->materials()->where('descricao', 'LIKE', "%{$data['descricao']}%")->paginate($itensPage)->toArray();
        }
    }
}
