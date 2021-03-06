<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateFilialFormRequest;
use App\Models\Filial;
use App\Models\Material;

class FilialController extends Controller
{
    private $filial;
    private $itensPage;

    // metodo para usar a instancia do modelo em todos os metodos.
    public function __construct(Filial $filial)
    {
        $this->filial = $filial;
    }

    // traz no formato json todos os dados da tabela.
    public function index(Request $request)
    {
        // aciona metodo da model filial.
        $filials = $this->filial->getResults($request->razao_social);
        // retorna no formato json.
        return response()->json($filials,200);
    }

    // inseri informação na tabela.
    public function store(StoreUpdateFilialFormRequest $request)
    {
        $filial =  $this->filial->create($request->all());
        return response()->json($filial, 201);
    }

    public function show($id)
    {
        // recupero o registro
        $filial =  $this->filial->with(['users', 'compras', 'vendas', 'materials'])->find($id);

        if(!$filial)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            // retorno o registro editado.
            return response()->json($filial, 200);
        }
    }

    // editar informação na tabela.
    public function update(StoreUpdateFilialFormRequest $request, $id)
    {
        // recupero o registro
        $filial =  $this->filial->find($id);

        if(!$filial)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            // seto os valores que o usuario forneceu.
            $filial-> update($request->all());
            // retorno o registro editado.
            return response()->json($filial, 200);
        }
    }

    public function destroy($id)
    {
        // recupero o registro
        $filial =  $this->filial->find($id);

        if(!$filial)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $existsRelations = $this->filial->find($id)->materials()->exists();
            // verifica se cliente esta relacionado a uma venda
            if ($existsRelations) {
                return response()->json(['error' => 'Existem relacionamentos para esta filial!'], 404);
            }
            $filial-> delete();
            // retorno o registro editado.
            return response()->json(['success' => true], 204);
        }
    }
    // relacão 1:N
    public function users($id)
    {
        /**
         * recupero o registro de filial e todos os registros de users vinculados ao tipo.
         * atribuo a propriedade $filial->users á variavel $users.
         */
        $filial =  $this->filial->find($id);

        if(!$filial)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $users = $filial->users()->paginate($this->itensPage);

            return response()->json([
                'filial'    => $filial,
                'users'     => $users,
            ]);
        }
    }

    // relacão 1:N
    public function compras($num_doc)
    {
        /**
         * recupero o registro de filial e todos os registros de users vinculados ao tipo.
         * atribuo a propriedade $filial->users á variavel $users.
         */
        $filial =  $this->filial->find($num_doc);
        if(!$filial)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $compras = $filial->compras()->paginate($this->itensPage);

            return response()->json([
                'filial'      => $filial,
                'compras'     => $compras,
            ]);
        }
    }

    // relacão 1:N
    public function vendas($id)
    {
        /**
         * recupero o registro de filial e todos os registros de users vinculados ao tipo.
         * atribuo a propriedade $filial->users á variavel $users.
         */
        $filial =  $this->filial->find($id);
        if(!$filial)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $vendas = $filial->vendas()->paginate($this->itensPage);

            return response()->json([
                'filial'   => $filial,
                'compras'  => $vendas,
            ]);
        }
    }

    // relacão N:M
    public function materials($id)
    {
        $filial = $this->filial->find($id);

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
}
