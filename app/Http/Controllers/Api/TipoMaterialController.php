<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tipo_material;
use App\Http\Requests\StoreUpdateTipoMaterialFormRequest;

class TipoMaterialController extends Controller
{
    private $tipoMaterial;
    private $itensPage;

    // metodo para usar a instancia do modelo em todos os metodos.
    public function __construct(Tipo_material $tipoMaterial)
    {
        $this->tipoMaterial = $tipoMaterial;
    }

    public function index(Request $request)
    {
        // aciona metodo da model tipoMaterial.
        $tipoMaterial = $this->tipoMaterial->getResults($request->tipo_material);
        // retorna no formato json.
        return response()->json($tipoMaterial, 200);
    }

    public function store(StoreUpdateTipoMaterialFormRequest $request)
    {
        $tipoMaterial =  $this->tipoMaterial->create($request->all());

        return response()->json($tipoMaterial, 201);
    }

    public function show($id)
    {
        // recupero o registro
        $tipoMaterial =  $this->tipoMaterial->with('materials')->find($id);

        if(!$tipoMaterial)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            // retorno o registro editado.
            return response()->json($tipoMaterial, 200);
        }
    }

    public function update(StoreUpdateTipoMaterialFormRequest $request, $id)
    {
        // recupero o registro
        $tipoMaterial =  $this->tipoMaterial->find($id);

        if(!$tipoMaterial)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            // seto os valores que o usuario forneceu.
            $tipoMaterial->update($request->all());
            // retorno o registro editado.
            return response()->json($tipoMaterial, 200);
        }
    }

    public function destroy($id)
    {
        // recupero o registro
        $tipoMaterial =  $this->tipoMaterial->find($id);

        if(!$tipoMaterial)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $existsRelations = $this->tipoMaterial->find($id)->materials()->exists();
            // verifica se existe relacionamento
            if ($existsRelations) {
                return response()->json(['error' => 'Tipo de material esta relacionado a um material'], 404);
            }
            $tipoMaterial->delete();
            // retorno o registro editado.
            return response()->json(['sucess' => true], 204);
        }
    }

    public function materials($id)
    {
        /**
         * recupero o registro de tipoMaterial e todos os registros de materials vinculados ao tipo.
         * atribuo a propriedade $tipoMaterial->materials á variavel $materials.
         */
        $tipoMaterial =  $this->tipoMaterial->find($id);

        if(!$tipoMaterial)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $materials = $tipoMaterial->materials()->paginate($this->itensPage);

            return response()->json([
                'tipo_material' => $tipoMaterial,
                'materials'     => $materials,
            ]);
        }
    }
}
