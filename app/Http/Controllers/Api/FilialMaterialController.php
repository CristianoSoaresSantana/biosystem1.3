<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Filial_material;
use App\Http\Requests\StoreUpdateFilialMaterialFormRequest;

class FilialMaterialController extends Controller
{
    private $filial_material;
    private $itensPage = 10;

    public function __construct(Filial_material $filial_material)
    {
        $this->filial_material = $filial_material;
    }

    // Retorna todos os registros da tabela por filial! Se houver input, retorna um ou mais registros!
    public function index(Request $request)
    {
        $materials = $this->filial_material->getResults($request->all(), $this->itensPage);
        return response()->json(['materials' => $materials], 200);
    }

    public function store(StoreUpdateFilialMaterialFormRequest $request)
    {
        $arrayRequest = $request;

        try
        {
            DB::beginTransaction(); //marcador para iniciar transações
            $filial = Filial::find($arrayRequest["filial_id"][0]);

            for ($i=0; $i < count($arrayRequest["filial_id"]); $i++){
                $filial->materials()->attach($arrayRequest["material_sku"][$i],
                    [
                        'min' => $arrayRequest["min"][$i],
                        'max' => $arrayRequest["max"][$i],
                        'curvaABC' => $arrayRequest["curvaABC"][$i],
                        'comissao' => $arrayRequest["comissao"][$i],
                        'valor_venda' => $arrayRequest["valor_venda"][$i],
                        'status' => $arrayRequest["status"][$i]
                    ]
                );
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

    // Retorna todos os produtos da filial em questão.
    public function show($id)
    {
        $filial = Filial::find($id);

        if(!$filial)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $materials = $filial->materials()->paginate($this->itensPage);

            return response()->json([
                'filial'   => $filial,
                'materials'  => $materials,
            ]);
        }
    }

    // Retorna um produto da filial em questão.
    public function showUm($filial_id, $material_sku)
    {
        $material = DB::table('filial_materials')
                        ->select('*')
                        ->where([
                                ['filial_id', '=', $filial_id],
                                ['material_sku', '=', $material_sku]
                            ])
                        ->get();
        // dd($material[0]->curvaABC);
        return response()->json([ 'materials'  => $material ]);
    }

    // Atualiza um produto do estoque
    public function update(StoreUpdateFilialMaterialFormRequest $request, $filial_id)
    {
        $filial = Filial::find($filial_id);

        if(!$filial)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {

            $filial = Filial::find($filial_id)->materials()->updateExistingPivot($request->material_sku,
            [
                'min' => $request->min,
                'max' => $request->max,
                'curvaABC' => $request->curvaABC,
                'comissao' => $request->comissao,
                'valor_venda' => $request->valor_venda,
                'status' => $request->status,
                ]
            );

            return response()->json($filial, 200);
        }
    }

    // Este metodo apaga todos os registros da pivot filial_materials, APAGA O ESTOQUE DA FILIAL.
    public function destroy($id)
    {
        $filial = Filial::find($id);

        $filial->materials()->detach();
        return response()->json(['success' => true], 204);
    }

    // Este metodo apaga UM registro da pivot filial_materials, APAGA UM ITEM DA FILIAL.
    public function destroyUm($filial_id, $material_sku)
    {
        $filial = Filial::find($filial_id);

        $filial->materials()->detach($material_sku);
        return response()->json(['success' => true], 204);
    }
}
