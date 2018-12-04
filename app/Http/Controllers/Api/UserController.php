<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StoreUpdateUserFormRequest;

class UserController extends Controller
{
    private $user;
    private $itensPage;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users = $this->user->getResults($request->all(), $this->itensPage);

        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUserFormRequest $request)
    {
        
        $users = $this->user->create($request->all());

        return response()->json($users, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->with(['setor', 'filial'])->find($id);

        if(!$user)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }
        return response()->json($user, 200);
    }
    
    /**
     * Update the specified resource in storage.
     * primeiro verifica se existe o user a ser editado!
     * segundo faz a alteração. e então retorna o registro editado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUserFormRequest $request, $id)
    {
        $user = $this->user->find($id);
        if(!$user)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }
        
        $user->update($request->all());
        
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);

        if(!$user)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }

        $user->delete();

        return response()->json(['success'], 204);
    }
}
