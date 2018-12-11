<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Http\Requests\StoreUpdateClienteFormRequest;

class ClienteController extends Controller
{
    private $cliente;
    private $itensPage;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientes = $this->cliente->getResults($request->all(), $this->itensPage);

        return response()->json($clientes, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clientes = $this->cliente->create($request->all());

        return response()->json($clientes, 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = $this->cliente->find($id);

        if(!$cliente)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }
        return response()->json($cliente, 200);
    }
    
    /**
     * Update the specified resource in storage.
     * primeiro verifica se existe o cliente a ser editado!
     * segundo faz a alteração. e então retorna o registro editado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateClienteFormRequest $request, $id)
    {
        $cliente = $this->cliente->find($id);
        if(!$cliente)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }
        
        $cliente->update($request->all());
        
        return response()->json($cliente, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = $this->cliente->find($id);

        if(!$cliente)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }

        $cliente->delete();

        return response()->json(['success'], 204);
    }
}
