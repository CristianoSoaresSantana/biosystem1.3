<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\Filial;
use App\Models\Venda;

class Material extends Model
{
    use SoftDeletes;
    use Notifiable;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'sku';
    protected $table = 'materials';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'sku',
        'tipo_material_id',
        'forma_farmaceutica_id',
        'cod_barra',
        'descricao',
        'valor_compra',
        'valor_revenda',
        'status',
        'image',
    ];

    public $timestamps = true;

    /**
     * Neste metodo, eu busco os dados paginando, por parametro ou sem parametro!
     * Se for informado um filter, este metodo faz uma busca hibrida,  senão ele
     * verifica qual parametro veio.
     */
    public function getResults($data, $itensPage)
    {
        if (!isset($data['filter']) && !isset($data['cod_barra']) && !isset($data['sku']) && !isset($data['descricao'])) {
            return $this->paginate($itensPage);
        }
        else
        {
            return $this->where(function ($query) use ($data){
                        if(isset($data['filter'])) 
                        {
                            $filter = $data['filter'];
                            $query->where('sku', 'LIKE', "%{$filter}%");
                            $query->orWhere('cod_barra', 'LIKE', "%{$filter}%");
                            $query->orWhere('descricao', 'LIKE', "%{$filter}%");
                        }

                        if(isset($data['sku']))
                        {
                            $filter = $data['sku'];
                            $query->where('sku', 'LIKE', "%{$filter}%");
                        }

                        if(isset($data['cod_barra']))
                        {
                            $filter = $data['cod_barra'];
                            $query->where('cod_barra', 'LIKE', "%{$filter}%");
                        }

                        if(isset($data['descricao']))
                        {
                            $filter = $data['descricao'];
                            $query->where('descricao', 'LIKE', "%{$filter}%");
                        }
                    })->paginate($itensPage); //toSQL(); para vê como esta acontecendo por traz de query
        }
        
    }

    /**
     ************************** relacionamento 1:M, pois uma forma é caracteristica de muitos *************************
     ************************** materiais e um material só pode ter uma forma                 *************************
     */
    public function tipo_material()
    {
        return $this->belongsTo(Tipo_material::class);
    }

    public function forma_farmaceutica()
    {
        return $this->belongsTo(Forma_farmaceutica::class);
    }


    /**
     ************************** relacionamento N:M, pois uma filial vende muitos  *************************
     ************************** materiais e um material é vendo por varias filias *************************
     */
    public function filial()
    {
        return $this->belongsToMany(Filial::class, 'filial_materials')
                    ->withPivot('quantidade', 'min', 'max', 'curvaABC', 'comissao', 'valor_venda', 'status');
    }

    public function fornecedor()
    {
        return $this->belongsToMany(Fornecedor::class, 'fornecedor_materials')->withPivot('created_at', 'updated_at');
    }

    public function vendas()
    {
        return $this->belongsToMany(Venda::class, 'material_vendas')
                    ->withPivot('quantidade', 'lote', 'valor_unitario', 'valor_com_desconto', 'desconto', 'justificativa_desconto', 'created_at', 'updated_at');
    }

    public function compras()
    {
        return $this->belongsToMany(Compra::class, 'compra_materials')
                    ->withPivot('quantidade', 'lote', 'valor_unitario', 'data_fabricacao', 'data_vencimento', 'created_at', 'updated_at');
    }
}