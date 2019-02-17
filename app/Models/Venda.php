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
use Illuminate\Support\Facades\DB;

class Venda extends Model
{
    use SoftDeletes;
    use Notifiable;

    public $timestamps = true;

    protected $dates = ['deleted_at'];
    protected $table = 'vendas';
    protected $fillable = ['id', 'cliente_id', 'filial_id', 'tipo_mov_id', 'user_id', 'valor_total', 'status', 'desconto', 'justificativa_desconto', 'total_com_desconto'];



    /**
     **************** Neste metodo, eu busco os dados paginando, por parametro ou sem parametro! ****************
     **************** Se for informado um filter, este metodo faz uma busca hibrida,  senão ele  ****************
     **************** verifica qual parametro veio.                                              ****************
     */
    public function getResults($data, $itensPage)
    {
        if (!isset($data['filter']) && !isset($data['id']) && !isset($data['created_at'])) {
            return $this->orderBy('id', 'DESC')->paginate($itensPage);
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
                    })->orderBy('created_at', 'DESC')->paginate($itensPage); //toSQL(); para vê como esta acontecendo por traz de query
        }

    }

    public function queryCreate($user_id, $cliente_id, $justificativa, $valor_total, $desconto, $total_com_desconto, $status, $tipo_mov_id, $itensVenda){
        try
        {
            DB::beginTransaction(); //marcador para iniciar transações

            /* criando registro de venda na tabela vendas */
            $this->user_id                  = $user_id;
            $this->cliente_id               = $cliente_id;
            $this->justificativa_desconto   = $justificativa;
            $this->valor_total              = $valor_total;
            $this->desconto                 = $desconto;
            $this->total_com_desconto       = $total_com_desconto;
            $this->tipo_mov_id              = $tipo_mov_id;
            $this->status                   = $status;
            $this->filial_id                = $itensVenda[0]['filial_id'];

            $this->save();

            /* pega o ultimo registro de venda */
            $venda_id = $this->latest()->value('id');
            /* cria um objeto com esse registro */
            $venda = $this->find($venda_id);

            /* criando registro dos itens desta venda */
            foreach ($itensVenda as $item) {
                $quantidade_anterior = $this->buscarQuantidadeAnterior($item['filial_id'], $item['sku']);
                $this->materials()->attach($item['sku'], ['valor_unitario' => $item['valor_unitario'], 'quantidade' => $item['quantidade'], 'quantidade_anterior' => $quantidade_anterior, 'lote' => $item['lote'], 'sub_total' => $item['sub_total']]);
                $this->baixaNoEstoque($item['filial_id'], $item['sku'], $item['quantidade']);
            }
        }catch(Exception $e) {
            throw new Exception('Error no Model' . $e->getMessage());
        }

        DB::commit(); //validar as transações
    }

    public function buscarQuantidadeAnterior($filial, $sku) {
        $filial = Filial::find($filial);
        return $filial->materials()->where('material_sku', $sku)->value('quantidade');
    }

    public function baixaNoEstoque($filial, $sku, $quantidade) {

        $filial = Filial::find($filial);
        // Aqui eu retorno o registro do produto por filial.
        $filial_material = $filial->materials()->where('material_sku', $sku)->first();

        // Aqui eu atualizo a quantidade do produto no estoque.
        $quantidadeNova = $filial_material->pivot->quantidade - $quantidade;
        $filial_material->pivot->quantidade = $quantidadeNova;
        $filial_material->pivot->save();
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
        return $this->belongsTo(Tipo_movimento::class, 'tipo_mov_id');
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
                    ->withPivot('quantidade', 'quantidade_anterior', 'lote', 'valor_unitario', 'desconto', 'sub_total', 'created_at', 'updated_at');
    }
}
