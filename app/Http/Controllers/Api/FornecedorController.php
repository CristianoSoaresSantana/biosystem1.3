<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateFornecedorFormRequest;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    private $fornecedor;

    // metodo para usar a instancia do modelo em todos os metodos.
    public function __construct(Fornecedor $fornecedor)
    {
        $this->fornecedor = $fornecedor;
    }

    // traz no formato json todos os dados da tabela.
    public function index(Request $request)
    {
        // aciona metodo da model Fornecedor.
        $fornecedors = $this->fornecedor->getResults($request->razao_social);
        // retorna no formato json.
        return response()->json($fornecedors, 200);
    }

    // inseri informação na tabela.
    public function store(StoreUpdateFornecedorFormRequest $request)
    {
        $fornecedor =  $this->fornecedor->create($request->all());

        return response()->json($fornecedor, 201);
    }

    public function show($id)
    {
        // recupero o registro
        $fornecedor =  $this->fornecedor->find($id);

        if(!$fornecedor)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            // retorno o registro editado.
            return response()->json($fornecedor, 200);
        }
    }
    
    // editar informação na tabela.
    public function update(StoreUpdateFornecedorFormRequest $request, $id)
    {
        // recupero o registro
        $fornecedor =  $this->fornecedor->find($id);

        if(!$fornecedor)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            // seto os valores que o usuario forneceu.
            $fornecedor->update($request->all());
            // retorno o registro editado.
            return response()->json($fornecedor, 200);
        }
    }

    public function destroy($id)
    {
        // recupero o registro
        $fornecedor =  $this->fornecedor->find($id);

        if(!$fornecedor)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $fornecedor->delete();
            // retorno o registro editado.
            return response()->json(['sucess' => true], 204);
        }
    }

    public function compras($id)
    {
        /**
         * recupero o registro de fornecedor e todos os registros de users vinculados ao tipo.
         * atribuo a propriedade $fornecedor->compras á variavel $users.
         */
        $fornecedor =  $this->fornecedor->find($id);
        if(!$fornecedor)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $compras = $fornecedor->compras()->paginate();
            
            return response()->json([
                'fornecedor' => $fornecedor,
                'compras'     => $compras,
            ]);
        }
    }

    // relacão N:M
    public function materials($id)
    {
        $fornecedor = $this->fornecedor->find($id);

        if(!$fornecedor)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $materials = $fornecedor->materials()->paginate();
            
            return response()->json([
                'fornecedor'   => $fornecedor,
                'materials'  => $materials,
            ]);
        }
    }
}
