<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Forma_farmaceutica;
use App\Http\Requests\StoreUpdateFormaFarmaceuticaFormRequest;

class FormaFarmaceuticaController extends Controller
{
    private $formaFarmaceutica;
    private $itensPage;

    // metodo para usar a instancia do modelo em todos os metodos.
    public function __construct(Forma_farmaceutica $formaFarmaceutica)
    {
        $this->formaFarmaceutica = $formaFarmaceutica;
    }

    public function index(Request $request)
    {
        // aciona metodo da model formaFarmaceutica.
        $formaFarmaceutica = $this->formaFarmaceutica->getResults($request->forma_farmaceutica);
        // retorna no formato json.
        return response()->json($formaFarmaceutica, 200);
    }

    public function store(StoreUpdateFormaFarmaceuticaFormRequest $request)
    {
        $formaFarmaceutica =  $this->formaFarmaceutica->create($request->all());

        return response()->json($formaFarmaceutica, 201);
    }

    public function show($id)
    {
        // recupero o registro
        $formaFarmaceutica =  $this->formaFarmaceutica->find($id);

        if(!$formaFarmaceutica)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            // retorno o registro editado.
            return response()->json($formaFarmaceutica, 200);
        }
    }

    public function update(StoreUpdateFormaFarmaceuticaFormRequest $request, $id)
    {
        // recupero o registro
        $formaFarmaceutica =  $this->formaFarmaceutica->find($id);

        if(!$formaFarmaceutica)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            // seto os valores que o usuario forneceu.
            $formaFarmaceutica->update($request->all());
            // retorno o registro editado.
            return response()->json($formaFarmaceutica, 200);
        }
    }

    public function destroy($id)
    {
        // recupero o registro
        $formaFarmaceutica =  $this->formaFarmaceutica->find($id);

        if(!$formaFarmaceutica)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $formaFarmaceutica->delete();
            // retorno o registro editado.
            return response()->json(['sucess' => true], 204);
        }
    }

    public function materials($id)
    {
        /**
         * recupero o registro de formaFarmaceutica e todos os registros de materials vinculados ao tipo.
         * atribuo a propriedade $formaFarmaceutica->materials á variavel $materials.
         */
        $formaFarmaceutica =  $this->formaFarmaceutica->find($id);
        
        if(!$formaFarmaceutica)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $materials = $formaFarmaceutica->materials()->paginate($this->itensPage);

            return response()->json([
                'forma_farmaceutica' => $formaFarmaceutica,
                'materials'     => $materials,
            ]);
        }
    }
}
