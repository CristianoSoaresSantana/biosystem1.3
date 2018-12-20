<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateFormaPagtoFormRequest;
use App\Models\Forma_pagto;

class FormaPagtoController extends Controller
{
    private $formaPagto;

    public function __construct(Forma_pagto $formaPagto)
    {
        $this->formaPagto = $formaPagto;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $formaPagto = $this->formaPagto->getResults($request->forma_pagto);

        return response()->json($formaPagto, 200);
    }


    // inseri informação na tabela.
    public function store(StoreUpdateformaPagtoFormRequest $request)
    {
        $formaPagto =  $this->formaPagto->create($request->all());

        return response()->json($formaPagto, 201);
    }

    public function show($id)
    {
        // recupero o registro
        $formaPagto =  $this->formaPagto->find($id);

        if(!$formaPagto)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            // retorno o registro editado.
            return response()->json($formaPagto, 200);
        }
    }

    public function update(StoreUpdateformaPagtoFormRequest $request, $id)
    {
        // recupero o registro
        $formaPagto =  $this->formaPagto->find($id);

        if(!$formaPagto)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            // seto os valores que o usuario forneceu.
            $formaPagto->update($request->all());
            // retorno o registro editado.
            return response()->json($formaPagto, 200);
        }
    }

    public function destroy($id)
    {
        // recupero o registro
        $formaPagto =  $this->formaPagto->find($id);

        if(!$formaPagto)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $existsRelations = $this->formaPagto->find($id)->vendas()->exists();
            // verifica se existe relacionamento
            if ($existsRelations) {
                return response()->json(['error' => 'Forma Pagamento esta relacionado a uma venda'], 404);
            }
            $formaPagto->delete();
            // retorno o registro editado.
            return response()->json(['sucess' => true], 204);
        }
    }

    public function vendas($id)
    {
        /**
         * recupero o registro de formaPagto e todos os registros de materials vinculados ao tipo.
         * atribuo a propriedade $formaPagto->materials á variavel $materials.
         */
        $formaPagto =  $this->formaPagto->find($id);

        if(!$formaPagto)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $vendas = $formaPagto->vendas()->paginate();

            return response()->json([
                'formaPagto' => $formaPagto,
                'vendas'     => $vendas,
            ]);
        }
    }
}
