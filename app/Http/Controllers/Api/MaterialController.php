<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Http\Requests\StoreUpdateMaterialFormRequest;
use Illuminate\Support\Facadas\Storege;

class MaterialController extends Controller
{
    private $material;
    private $itensPage;

    public function __construct(Material $material)
    {
        $this->material = $material;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $materials = $this->material->getResults($request->all(), $this->itensPage);

        return response()->json($materials, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateMaterialFormRequest $request)
    {
        // inicio - realizando upload de imagens
        $data = $request->all();
        if ($request->hasFile('image') && $request->file('image')->isValid())
        {
            // aqui eu pego o sku para definir o nome da imagem
            $nomeImage = kebab_case($request->sku);
            // aqui eu pego a extenção da image.
            $extensionImage = $request->file('image')->extension();
            // aqui eu crio o nome da image, concatenando as var anteriores.
            $nameFile = "{$nomeImage}.{$extensionImage}";
            // aqui eu atribuo o nome da imgem ao $data array de dados informados pelo usuario.
            $data['image'] = $nameFile;
            
            $upload = $request->file('image')->storeAs('materials', $nameFile);
            
            if(!$upload)
            {
                return response()->json(['error' => 'Fail UpLoad'], 500);
            }
        }
        // fim

        $materials = $this->material->create($data);

        return response()->json($materials, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material = $this->material->find($id);

        if(!$material)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }
        return response()->json($material, 200);
    }
    //ESTOU COM PROBLEMA NO VIDEO 27
    /**
     * Update the specified resource in storage.
     * primeiro verifica se existe o material a ser editado!
     * segundo faz a alteração. e então retorna o registro editado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateMaterialFormRequest $request, $id)
    {
        $material = $this->material->find($id);

        if(!$material)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }
        // inicio upload da imagens
        $data = $request->all();
        if ($request->hasFile('image') && $request->file('image')->isValid())
        {
            // deletar a imagem e fazer upload outra vez, assim a imagem sempre vai ter o nome do materail.
            if($material->image)
            {
                if(Storage::exists("materials/{$material->image}"))
                {
                    Storage::delete("materials/{$material->image}");
                }
            }
            // aqui eu pego o sku para definir o nome da imagem
            $nomeImage = kebab_case($request->sku);
            // aqui eu pego a extenção da image.
            $extensionImage = $request->file('image')->extension();
            // aqui eu crio o nome da image, concatenando as var anteriores.
            $nameFile = "{$nomeImage}.{$extensionImage}";
            // aqui eu atribuo o nome da imgem ao $data array de dados informados pelo usuario.
            $data['image'] = $nameFile;
            
            $upload = $request->file('image')->storeAs('materials', $nameFile);
            
            if(!$upload)
            {
                return response()->json(['error' => 'Fail UpLoad'], 500);
            }
        }
        // fim
        $material->update($data);

        return response()->json($material, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $material = $this->material->find($id);

        if(!$material)
        {
            return response()->json(['error' => 'Not Found'], 404);
        }

        $material->delete();

        return response()->json(['success'], 204);
    }
}