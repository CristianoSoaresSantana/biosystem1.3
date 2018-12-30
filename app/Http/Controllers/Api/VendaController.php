<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateVendaFormRequest;
use App\Models\Venda;

class VendaController extends Controller
{
    private $venda;
    private $itensPage;

    // metodo para usar a instancia do modelo em todos os metodos.
    public function __construct(Venda $venda)
    {
        $this->venda = $venda;
    }

    // traz no formato json todos os dados da tabela.
    public function index(Request $request)
    {
        // aciona metodo da model venda.
        $vendas = $this->venda->getResults($request->all(), $this->itensPage);
        // retorna no formato json.
        return response()->json($vendas, 200);
    }

    // inseri informação na tabela.
    public function store(StoreUpdateVendaFormRequest $request)
    {
        $vendas =  $this->venda->create($request->all());
        return response()->json($vendas, 201);
    }

    public function show($id)
    {
        // recupero o registro
        $venda =  $this->venda->with(['filial', 'cliente', 'user', 'tipoMovimento', 'formaPagtos'])->find($id);
        if(!$venda)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            // retorno o registro editado.
            return response()->json($venda, 200);
        }
    }

    // editar informação na tabela.
    public function update(StoreUpdateVendaFormRequest $request, $id)
    {
        // recupero o registro
        $venda =  $this->venda->find($id);

        if(!$venda)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            // seto os valores que o usuario forneceu.
            $venda-> update($request->all());
            // retorno o registro editado.
            return response()->json($venda, 200);
        }
    }

    public function destroy($id)
    {
        // recupero o registro
        $venda =  $this->venda->find($id);

        if(!$venda)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $venda-> delete();
            // retorno o registro editado.
            return response()->json(['sucess' => true], 204);
        }
    }

    // Neste metodo eu listo a forma de pagto de uma venda.
    public function formaPagtos($id)
    {
        $venda = $this->venda->find($id);

        if(!$venda)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $formaPagtos = $venda->formaPagtos()->paginate($this->itensPage);

            return response()->json([
                'venda'  => $venda,
                'formaPagtos'   => $formaPagtos,
            ]);
        }
    }

    // Neste metodo eu listo os itens de uma venda
    public function materials($id)
    {
        $venda = $this->venda->find($id);

        if(!$venda)
        {
            // retornar uma mensagem se não encontrar o arquivo.
            return response()->json(['error' => 'Not Found'], 404);
        }
        else
        {
            $materials = $venda->materials()->paginate($this->itensPage);

            return response()->json([
                'venda'  => $venda,
                'materials'   => $materials,
            ]);
        }
    }
}
