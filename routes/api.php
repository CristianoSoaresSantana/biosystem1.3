<?php

use Illuminate\Http\Request;

// //Rotas manuais para o CRUD filials
// $this->get('filials', 'Api\FilialController@index');
// $this->post('filials', 'Api\FilialController@store');
// $this->put('filials/{id}', 'Api\FilialController@update');
// $this->delete('filials/{id}', 'Api\FilialController@delete');

$this->post('auth', 'Auth\AuthApiController@authenticate');

//Rotas para tebelas concretas.
$this->apiResource('users', 'Api\UserController'); // CRUD
$this->apiResource('clientes', 'Api\ClienteController'); // CRUD

$this->apiResource('compras', 'Api\CompraController'); // CRUD
$this->get('compras/{id}/materials', 'Api\CompraController@materials'); // RELACIONAMENTO N:M, CONSULTA.

$this->apiResource('forma_pagtos', 'Api\FormaPagtoController'); // CRUD
$this->get('formaPagtos/{id}/vendas', 'Api\FormaPagtoController@vendas'); // RELACIONAMENTO N:M, CONSULTA.

$this->apiResource('vendas', 'Api\VendaController'); // CRUD
$this->get('vendas/{id}/formaPagtos', 'Api\VendaController@formaPagtos'); // RELACIONAMENTO N:M, CONSULTA.
$this->get('vendas/{id}/materials', 'Api\VendaController@materials'); // RELACIONAMENTO N:M, CONSULTA.

$this->apiResource('materials', 'Api\MaterialController'); // CRUD
$this->get('materials/{id}/filial', 'Api\MaterialController@filial'); // RELACIONAMENTO N:M, CONSULTA.
$this->get('materials/{id}/fornecedor', 'Api\MaterialController@fornecedor'); // RELACIONAMENTO N:M, CONSULTA.
$this->get('materials/{sku}/vendas', 'Api\MaterialController@vendas'); // RELACIONAMENTO N:M, CONSULTA.
$this->get('materials/{sku}/compras', 'Api\MaterialController@compras'); // RELACIONAMENTO N:M, CONSULTA.

$this->apiResource('filials', 'Api\FilialController'); // CRUD
$this->get('filials/{id}/users', 'Api\FilialController@users'); // RELACIONAMENTO 1:M, CONSULTA
$this->get('filials/{id}/compras', 'Api\FilialController@compras'); // RELACIONAMENTO 1:M, CONSULTA
$this->get('filials/{id}/vendas', 'Api\FilialController@vendas'); // RELACIONAMENTO 1:M, CONSULTA
$this->get('filials/{id}/materials', 'Api\FilialController@materials'); // RELACIONAMENTO N:M, CONSULTA.

$this->apiResource('setors', 'Api\SetorController'); // CRUD
$this->get('setors/{id}/users', 'Api\SetorController@users'); // RELACIONAMENTO 1:M, CONSULTA

$this->apiResource('tipo_materials', 'Api\TipoMaterialController'); // CRUD
$this->get('tipo_materials/{id}/materials', 'Api\TipoMaterialController@materials'); // RELACIONAMENTO 1:M, CONSULTA

$this->apiResource('tipo_movimentos', 'Api\TipoMovimentoController'); // CRUD
$this->get('tipo_movimentos/{id}/compras', 'Api\TipoMovimentoController@compras'); // RELACIONAMENTO 1:M, CONSULTA
$this->get('tipo_movimentos/{id}/vendas', 'Api\TipoMovimentoController@vendas'); // RELACIONAMENTO 1:M, CONSULTA

$this->apiResource('forma_farmaceuticas', 'Api\FormaFarmaceuticaController'); // CRUD
$this->get('forma_farmaceuticas/{id}/materials', 'Api\FormaFarmaceuticaController@materials'); // RELACIONAMENTO 1:M, CONSULTA

$this->apiResource('fornecedors', 'Api\FornecedorController'); // CRUD
$this->get('fornecedors/{id}/compras', 'Api\FornecedorController@compras'); // RELACIONAMENTO 1:M, CONSULTA
$this->get('fornecedors/{id}/materials', 'Api\FornecedorController@materials'); // RELACIONAMENTO N:M, CONSULTA.
