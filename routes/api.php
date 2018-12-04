<?php

use Illuminate\Http\Request;

// //Rotas manuais para o CRUD filials
// $this->get('filials', 'Api\FilialController@index');
// $this->post('filials', 'Api\FilialController@store');
// $this->put('filials/{id}', 'Api\FilialController@update');
// $this->delete('filials/{id}', 'Api\FilialController@delete');

//Rotas para tebelas concretas.
$this->apiResource('forma_pagtos', 'Api\FormaPagtoController');
$this->apiResource('materials', 'Api\MaterialController');
$this->apiResource('users', 'Api\UserController');
$this->apiResource('clientes', 'Api\ClienteController');
$this->apiResource('compras', 'Api\CompraController');
$this->apiResource('vendas', 'Api\VendaController');


$this->apiResource('filials', 'Api\FilialController');
$this->get('filials/{id}/users', 'Api\FilialController@users'); // Relação 1:N.
$this->get('filials/{id}/compras', 'Api\FilialController@compras'); // Relação 1:N.
$this->get('filials/{id}/vendas', 'Api\FilialController@vendas'); // Relação 1:N.

$this->apiResource('setors', 'Api\SetorController');
$this->get('setors/{id}/users', 'Api\SetorController@users'); // Relação 1:N.


$this->apiResource('tipo_materials', 'Api\TipoMaterialController');
$this->get('tipo_materials/{id}/materials', 'Api\TipoMaterialController@materials'); // Relação 1:N.

$this->apiResource('tipo_movimentos', 'Api\TipoMovimentoController');
$this->get('tipo_movimentos/{id}/compras', 'Api\TipoMovimentoController@compras'); // Relação 1:N.
$this->get('tipo_movimentos/{id}/vendas', 'Api\TipoMovimentoController@vendas'); // Relação 1:N.

$this->apiResource('forma_farmaceuticas', 'Api\FormaFarmaceuticaController');
$this->get('forma_farmaceuticas/{id}/materials', 'Api\FormaFarmaceuticaController@materials'); // Relação 1:N.

$this->apiResource('fornecedors', 'Api\FornecedorController');
$this->get('fornecedors/{id}/compras', 'Api\FornecedorController@compras'); // Relação 1:N.
