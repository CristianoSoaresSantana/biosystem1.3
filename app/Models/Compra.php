<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\Fornecedor;
use App\Models\Filial;
use App\Models\Tipo_movimento;
use App\Models\Material;

class Compra extends Model
{
    use SoftDeletes;
    use Notifiable;

    public $timestamps = true;
    public $incrementing = false;

    protected $keyType = 'string';
    protected $primaryKey = 'num_doc';
    protected $dates = ['deleted_at'];
    protected $table = 'compras';
    protected $fillable = ['num_doc', 'filial_id', 'tipo_mov_id', 'fornecedor_id', 'valor_nota',];



    /**
     * Neste metodo, eu busco os dados paginando, por parametro ou sem parametro!
     * Se for informado um filter, este metodo faz uma busca hibrida,  senão ele
     * verifica qual parametro veio.
     */
    public function getResults($data, $itensPage)
    {
        if (!isset($data['filter']) && !isset($data['num_doc']) && !isset($data['created_at'])) {
            return $this->orderBy('created_at', 'DESC')->paginate($itensPage);
        }
        else
        {
            return $this->where(function ($query) use ($data){
                        if(isset($data['filter']))
                        {
                            $filter = $data['filter'];
                            $query->where('num_doc', 'LIKE', "%{$filter}%");
                            $query->orWhere('created_at', 'LIKE', "%{$filter}%");
                        }

                        if(isset($data['num_doc']))
                        {
                            $filter = $data['num_doc'];
                            $query->where('num_doc', 'LIKE', "%{$filter}%");
                        }

                        if(isset($data['created_at']))
                        {
                            $filter = $data['created_at'];
                            $query->where('created_at', 'LIKE', "%{$filter}%");
                        }
                    })->orderBy('created_at', 'DESC')->paginate($itensPage); //toSQL(); para vê como esta acontecendo por traz de query
        }

    }

    /**
     * relacionamento 1:M.
     * Está classe tem muitos relacionamentos!
     */
    public function filial()
    {
        return $this->belongsTo(Filial::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function tipoMovimento()
    {
        return $this->belongsTo(Tipo_movimento::class, 'tipo_mov_id');
    }

    /**
     ************************** relacionamento N:M, pois uma compra vende muitos    *************************
     ************************** materiais e um material pode esta em varias compras *************************
     */
    public function materials()
    {
        return $this->belongsToMany(Material::class, 'compra_materials')
                    ->withPivot('compra_num_doc', 'material_sku', 'quantidade', 'quantidade_anterior', 'lote', 'valor_unitario', 'data_fabricacao', 'data_vencimento', 'created_at', 'updated_at');
    }
}
