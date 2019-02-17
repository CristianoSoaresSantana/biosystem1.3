<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Compra;
use App\Models\Filial;
use App\Models\Material;
use Illuminate\Support\Facades\DB;

class CompraMaterialController extends Controller
{
    private $compra;

    // metodo para usar a instancia do modelo em todos os metodos.
    public function __construct(Compra $compra)
    {
        $this->compra = $compra;
    }

    /**
     * Retorna todos os registros da tabela pivot compra_materials.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compra_materials = DB::select('select * from compra_materials');
        return response()->json($compra_materials, 200);
    }

    /**
     * Estou fazendo o insert na tabela pivot de compra_materials.
     * Encontrar o objeto compra para referenciar os itens!
     * Inserir de forma dinaminca na tabela pivot!
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arrayRequest = $request->request->all();
        try
        {
            DB::beginTransaction(); //marcador para iniciar transações

            $compra_material = $this->compra->find($arrayRequest[0]["compra_num_doc"]); // Objeto da tabela pivot compra_materials

            $filial = Filial::find($compra_material->filial_id); // Objeto da tabela filial
            if($compra_material->tipo_mov_id != 2)
            {
                // Aqui acontece o attach na pivot compra_materials e o update na pivot filial_materials.
                for ($i=0; $i < $request->request->count(); $i++)
                {
                    // Aqui eu retorno o registro do produto por filial.
                    $filial_material = $filial->materials()->where('material_sku', $arrayRequest[$i]["material_sku"])->first();

                    // Aqui eu crio o registro na tabela compra_material.
                    $compra_material->materials()->attach($arrayRequest[$i]["material_sku"],
                        [
                            'quantidade'            => $arrayRequest[$i]["quantidade"],
                            'quantidade_anterior'   => $filial_material->pivot->quantidade,
                            'lote'                  => $arrayRequest[$i]["lote"],
                            'valor_unitario'        => $arrayRequest[$i]["valor_unitario"],
                            'data_fabricacao'       => $arrayRequest[$i]["data_fabricacao"],
                            'data_vencimento'       => $arrayRequest[$i]["data_vencimento"]
                        ]);

                    // Aqui eu atualizo a quantidade do produto no estoque.
                    $quantidadeNova = $filial_material->pivot->quantidade + $arrayRequest[$i]["quantidade"];
                    $filial_material->pivot->quantidade = $quantidadeNova;
                    $filial_material->pivot->save();

                    // Aqui eu atualizo o valor no produto na tabela material.
                    $material = Material::find($arrayRequest[$i]["material_sku"]);
                    $material->update(['valor_compra' => $arrayRequest[$i]["valor_unitario"]]);
                }
            }else {
                $filial_fornecedor = Filial::find($compra_material->fornecedor_id);
                // Aqui acontece o attach na pivot compra_materials e o update na pivot filial_materials.
                for ($i=0; $i < $request->request->count(); $i++)
                {
                    // Aqui eu retorno o registro do produto por filial.
                    $filial_material = $filial->materials()->where('material_sku', $arrayRequest[$i]["material_sku"])->first();
                    $filial_material_fornecedor = $filial_fornecedor->materials()->where('material_sku', $arrayRequest[$i]["material_sku"])->first();

                    // Aqui eu crio o registro na tabela compra_material.
                    $compra_material->materials()->attach($arrayRequest[$i]["material_sku"],
                        [
                            'quantidade'            => $arrayRequest[$i]["quantidade"],
                            'quantidade_anterior'   => $filial_material->pivot->quantidade,
                            'lote'                  => $arrayRequest[$i]["lote"],
                            'valor_unitario'        => $arrayRequest[$i]["valor_unitario"],
                            'data_fabricacao'       => $arrayRequest[$i]["data_fabricacao"],
                            'data_vencimento'       => $arrayRequest[$i]["data_vencimento"]
                        ]);

                    // Aqui eu atualizo a quantidade do produto no estoque, da filial destino!
                    $quantidadeNova = $filial_material->pivot->quantidade + $arrayRequest[$i]["quantidade"];
                    $filial_material->pivot->quantidade = $quantidadeNova;
                    // Aqui eu atualizo a quantidade do produto no estoque, da filial origem!
                    $quantidadeNovaFornecedor = $filial_material_fornecedor->pivot->quantidade - $arrayRequest[$i]["quantidade"];
                    $filial_material_fornecedor->pivot->quantidade = $quantidadeNovaFornecedor;

                    $filial_material->pivot->save();
                    $filial_material_fornecedor->pivot->save();

                    // Aqui eu atualizo o valor no produto na tabela material.
                    $material = Material::find($arrayRequest[$i]["material_sku"]);
                    $material->update(['valor_compra' => $arrayRequest[$i]["valor_unitario"]]);
                }
            }

            DB::commit(); //validar as transações

            return response()->json("success", 201);
        }
        catch(\Exception $e)
        {
            DB::rollback(); //reverter tudo, caso tenha acontecido algum erro.
            return response()->json($e->getMessage());
        }
    }

    /**
     * Retorna todos os itens de uma compra!.
     * Primeiro procura um registro de compra pelo numero do documento.
     * Então acessar os itens relacionandos a essa compra.
     * Para então acessar a tabela pivot e retornar os registros da tabela pivot no formato json.
     *
     * @param  int  $num_doc
     * @return \Illuminate\Http\Response
     */
    public function show($num_doc)
    {
        $itensCompra = [];
        $compra = $this->compra->find($num_doc);
        foreach ($compra->materials as $iten) {
            $this->itensCompra[] = $iten->pivot;
        }
        return response()->json($this->itensCompra, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($num_doc)
    {
        $compra_material = $this->compra->find($num_doc); // recupero o registro da compra!
        $filial = Filial::find($compra_material->filial_id); // recupero a filial relacionada a compra!

        foreach ($compra_material->materials as $itens) {
            $filial_material = $filial->materials()->where('material_sku', $itens->pivot->material_sku)->first(); // recupero os materials que os itens da compra faz referencia!
            $filial_material->pivot->quantidade = $itens->pivot->quantidade_anterior; // atribuo a quantidade_anterior da compra_materials a quantidade da tabela filial_materials!
            $filial_material->pivot->save(); // aqui eu salvo!
        }
        $compra_material->materials()->detach(); // aqui eu apago todos os registros que essa compra tem em compra_materials!
        return response()->json(['success' => true], 204);
    }
}
