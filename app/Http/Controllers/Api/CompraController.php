<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCompraFormRequest;
use App\Models\Compra;

class CompraController extends Controller
{
    private $compra;
    private $itensPage;

    // metodo para usar a instancia do modelo em todos os metodos.
    public function __construct(Compra $compra)
    {
        $this->compra = $compra;
    }

    // traz no formato json todos os dados da tabela.
    public function index(Request $request)
    {
        // aciona metodo da model compra.
        $compras = $this->compra->getResults($request->all(), $this->itensPage);
        // retorna no formato json.
        return response()->json($compras, 200);
    }

    // inseri informação na tabela.
    public function store(StoreUpdateCompraFormRequest $request)
    {

        $compra =  $this->compra->create($request->all());

        return response()->json($compra, 201);
    }

    public function show($id)
    {
        // recupero o registro
        $compra =  $this->compra->with(['filial', 'fornecedor', 'tipoMovimento', 'materials'])->find($id);

        if(!$compra)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            // retorno o registro editado.
            return response()->json($compra, 200);
        }
    }

    // editar informação na tabela.
    public function update(StoreUpdateCompraFormRequest $request, $id)
    {
        // recupero o registro
        $compra =  $this->compra->find($id);

        if(!$compra)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            // seto os valores que o usuario forneceu.
            $compra-> update($request->all());
            // retorno o registro editado.
            return response()->json($compra, 200);
        }
    }

    public function destroy($id)
    {
        // recupero o registro
        $compra =  $this->compra->find($id);

        if(!$compra)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $compra-> delete();
            // retorno o registro editado.
            return response()->json(['sucess' => true], 204);
        }
    }

    // Neste metodo eu listo os itens de uma compra
    public function materials($id)
    {
        $compra = $this->compra->find($id);

        if(!$compra)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $materials = $compra->materials()->paginate($this->itensPage);

            return response()->json([
                'compra'  => $compra,
                'materials'   => $materials,
            ]);
        }
    }
}
