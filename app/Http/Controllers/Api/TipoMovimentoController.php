<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTipoMovimentoFormRequest;
use App\Models\Tipo_movimento;

class TipoMovimentoController extends Controller
{
    private $tipoMovimento;

    public function __construct(Tipo_movimento $tipoMovimento)
    {
        $this->tipoMovimento = $tipoMovimento;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $tipoMovimento = $this->tipoMovimento->getResults($request->tipo_movimentacao);

        return response()->json($tipoMovimento, 200);
    }


    // inseri informação na tabela.
    public function store(StoreUpdateTipoMovimentoFormRequest $request)
    {
        $tipoMovimento =  $this->tipoMovimento->create($request->all());

        return response()->json($tipoMovimento, 201);
    }

    public function show($id)
    {
        // recupero o registro
        $tipoMovimento =  $this->tipoMovimento->find($id);

        if(!$tipoMovimento)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            // retorno o registro editado.
            return response()->json($tipoMovimento, 200);
        }
    }

    public function update(StoreUpdateTipoMovimentoFormRequest $request, $id)
    {
        // recupero o registro
        $tipoMovimento =  $this->tipoMovimento->find($id);

        if(!$tipoMovimento)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            // seto os valores que o usuario forneceu.
            $tipoMovimento->update($request->all());
            // retorno o registro editado.
            return response()->json($tipoMovimento, 200);
        }
    }

    public function destroy($id)
    {
        // recupero o registro
        $tipoMovimento =  $this->tipoMovimento->find($id);

        if(!$tipoMovimento)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $tipoMovimento->delete();
            // retorno o registro editado.
            return response()->json(['sucess' => true], 204);
        }
    }

    public function compras($id)
    {
        /**
         * recupero o registro de tipoMovimento e todos os registros de materials vinculados ao tipo.
         * atribuo a propriedade $tipoMovimento->materials á variavel $materials.
         */
        $tipoMovimento =  $this->tipoMovimento->find($id);
        if(!$tipoMovimento)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $compras = $tipoMovimento->compras()->paginate();

            return response()->json([
                'tipo_movimentos' => $tipoMovimento,
                'compras'     => $compras,
            ]);
        }
    }

    // public function vendas($id)
    // {
    //     /**
    //      * recupero o registro de tipoMovimento e todos os registros de materials vinculados ao tipo.
    //      * atribuo a propriedade $tipoMovimento->materials á variavel $materials.
    //      */
    //     $tipoMovimento =  $this->tipoMovimento->find($id);
        
    //     if(!$tipoMovimento)
    //     {
    //         return response()->json(['error' => 'Not Found'], 404);
    //     }
    //     else
    //     {
    //         $vendas = $tipoMovimento->vendas()->paginate($this->itensPage);

    //         return response()->json([
    //             'tipo_movimentos' => $tipoMovimento,
    //             'vendas'     => $vendas,
    //         ]);
    //     }
    // }
    
}
