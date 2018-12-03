<?php

use Illuminate\Http\Request;

// //Rotas manuais para o CRUD filials
// $this->get('filials', 'Api\FilialController@index');
// $this->post('filials', 'Api\FilialController@store');
// $this->put('filials/{id}', 'Api\FilialController@update');
// $this->delete('filials/{id}', 'Api\FilialController@delete');

//Rotas para tebelas concretas.
$this->apiResource('filials', 'Api\FilialController');
$this->apiResource('setors', 'Api\SetorController');
$this->apiResource('materials', 'Api\MaterialController');
$this->apiResource('tipo_materials', 'Api\TipoMaterialController');
$this->apiResource('forma_farmaceuticas', 'Api\FormaFarmaceuticaController');
$this->apiResource('fornecedors', 'Api\FornecedorController');
$this->apiResource('users', 'Api\UserController');

//Rotas para relacionamentos entre tabelas.
$this->get('tipo_materials/{id}/materials', 'Api\TipoMaterialController@materials');
$this->get('forma_farmaceuticas/{id}/materials', 'Api\FormaFarmaceuticaController@materials');
$this->get('setors/{id}/users', 'Api\SetorController@users');
$this->get('filials/{id}/users', 'Api\FilialController@users');