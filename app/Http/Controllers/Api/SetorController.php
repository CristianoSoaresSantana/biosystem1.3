<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSetorFormRequest;
use App\Models\Setor;

class SetorController extends Controller
{
    private $setor;
    private $itensPage;

    // metodo para usar a instancia do modelo em todos os metodos.
    public function __construct(Setor $setor)
    {
        $this->setor = $setor;
    }

    // traz no formato json todos os dados da tabela.
    public function index(Request $request)
    {
        // aciona metodo da model filial.
        $setors = $this->setor->getResults($request->setor);
        // retorna no formato json.
        return response()->json($setors, 200);
    }

    // inseri informação na tabela.
    public function store(StoreUpdateSetorFormRequest $request)
    {
        $setor =  $this->setor->create($request->all());

        return response()->json($setor, 201);
    }

    public function show($id)
    {
        // recupero o registro
        $setor =  $this->setor->with('users')->find($id);

        if(!$setor)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            // retorno o registro editado.
            return response()->json($setor, 200);
        }
    }

    // editar informação na tabela.
    public function update(StoreUpdateSetorFormRequest $request, $id)
    {
        // recupero o registro
        $setor =  $this->setor->find($id);

        if(!$setor)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            // seto os valores que o usuario forneceu.
            $setor-> update($request->all());
            // retorno o registro editado.
            return response()->json($setor, 200);
        }
    }

    public function destroy($id)
    {
        // recupero o registro
        $setor =  $this->setor->find($id);

        if(!$setor)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $existsRelations = $this->setor->find($id)->users()->exists();
            // verifica se existe relacionamento
            if ($existsRelations) {
                return response()->json(['error' => 'Setor esta relacionado a usuario'], 404);
            }
            $setor->delete();
            return response()->json(['sucess' => true], 204);
        }
    }

    public function users($id)
    {
        /**
         * recupero o registro de setor e todos os registros de users vinculados ao tipo.
         * atribuo a propriedade $setor->users á variavel $users.
         */
        $setor =  $this->setor->find($id);

        if(!$setor)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $users = $setor->users()->paginate($this->itensPage);

            return response()->json([
                'setor' => $setor,
                'users'     => $users,
            ]);
        }
    }
}
