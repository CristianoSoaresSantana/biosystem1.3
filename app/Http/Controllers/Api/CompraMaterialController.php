<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Compra;
use App\Models\Filial;
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
        try
        {
            DB::beginTransaction(); //marcador para iniciar transações

            $compra_material = $this->compra->find($request->num_doc); // Objeto da tabela pivot compra_materials
            $filial = Filial::find($compra_material->filial_id); // Objeto da tabela filial

            // Aqui acontece o attach na pivot compra_materials e o update na pivot filial_materials.
            for ($i=0; $i < count($request->material_sku); $i++)
            {
                $filial_material = $filial->materials()->where('material_sku', $request->material_sku[$i])->first(); // Objeto da tabela pivot filial_materials

                $compra_material->materials()->attach($request->material_sku[$i],
                    [
                        'quantidade'            => $request->quantidade[$i],
                        'quantidade_anterior'   => $filial_material->pivot->quantidade,
                        'lote'                  => $request->lote[$i],
                        'valor_unitario'        => $request->valor_unitario[$i],
                        'data_fabricacao'       => $request->data_fabricacao[$i],
                        'data_vencimento'       => $request->data_vencimento[$i]
                    ]);
                $quantidadeNova = $filial_material->pivot->quantidade + $request->quantidade[$i];
                $filial_material->pivot->quantidade = $quantidadeNova;
                $filial_material->pivot->save();
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
