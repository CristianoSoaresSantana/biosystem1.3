<?php

use Illuminate\Http\Request;

// //Rotas manuais para o CRUD filials
// $this->get('filials', 'Api\FilialController@index');
// $this->post('filials', 'Api\FilialController@store');
// $this->put('filials/{id}', 'Api\FilialController@update');
// $this->delete('filials/{id}', 'Api\FilialController@delete');

$this->post('auth', 'Auth\AuthApiController@authenticate');
$this->get('user', 'Auth\AuthApiController@getAuthenticatedUser');

$this->group([
    'namespace'  => 'Api',
    // 'middleware' => 'auth:api'
], function (){

    //Rotas para tebelas concretas.
    $this->apiResource('users', 'UserController'); // CRUD
    $this->apiResource('clientes', 'ClienteController'); // CRUD

    $this->apiResource('compras', 'CompraController'); // CRUD
    $this->get('compras/{id}/materials', 'CompraController@materials'); // RELACIONAMENTO N:M, CONSULTA.

    $this->apiResource('compra_materials', 'CompraMaterialController'); // CRUD Representa a entrada de material.

    $this->apiResource('forma_pagtos', 'FormaPagtoController'); // CRUD
    $this->get('formaPagtos/{id}/vendas', 'FormaPagtoController@vendas'); // RELACIONAMENTO N:M, CONSULTA.

    $this->apiResource('vendas', 'VendaController'); // CRUD
    $this->get('vendas/{id}/formaPagtos', 'VendaController@formaPagtos'); // RELACIONAMENTO N:M, CONSULTA.
    $this->get('vendas/{id}/materials', 'VendaController@materials'); // RELACIONAMENTO N:M, CONSULTA.

    $this->apiResource('materials', 'MaterialController'); // CRUD
    $this->get('materials/{id}/filial', 'MaterialController@filial'); // RELACIONAMENTO N:M, CONSULTA.
    $this->get('materials/{id}/fornecedor', 'MaterialController@fornecedor'); // RELACIONAMENTO 1:N, CONSULTA.
    $this->get('materials/{sku}/vendas', 'MaterialController@vendas'); // RELACIONAMENTO N:M, CONSULTA.
    $this->get('materials/{sku}/compras', 'MaterialController@compras'); // RELACIONAMENTO N:M, CONSULTA.

    $this->apiResource('filials', 'FilialController'); // CRUD
    $this->get('filials/{id}/users', 'FilialController@users'); // RELACIONAMENTO 1:M, CONSULTA
    $this->get('filials/{id}/compras', 'FilialController@compras'); // RELACIONAMENTO 1:M, CONSULTA
    $this->get('filials/{id}/vendas', 'FilialController@vendas'); // RELACIONAMENTO 1:M, CONSULTA
    $this->get('filials/{id}/materials', 'FilialController@materials'); // RELACIONAMENTO N:M, CONSULTA.

    $this->apiResource('setors', 'SetorController'); // CRUD
    $this->get('setors/{id}/users', 'SetorController@users'); // RELACIONAMENTO 1:M, CONSULTA

    $this->apiResource('tipo_materials', 'TipoMaterialController'); // CRUD
    $this->get('tipo_materials/{id}/materials', 'TipoMaterialController@materials'); // RELACIONAMENTO 1:M, CONSULTA

    $this->apiResource('tipo_movimentos', 'TipoMovimentoController'); // CRUD
    $this->get('tipo_movimentos/{id}/compras', 'TipoMovimentoController@compras'); // RELACIONAMENTO 1:M, CONSULTA
    $this->get('tipo_movimentos/{id}/vendas', 'TipoMovimentoController@vendas'); // RELACIONAMENTO 1:M, CONSULTA

    $this->apiResource('forma_farmaceuticas', 'FormaFarmaceuticaController'); // CRUD
    $this->get('forma_farmaceuticas/{id}/materials', 'FormaFarmaceuticaController@materials'); // RELACIONAMENTO 1:M, CONSULTA

    $this->apiResource('fornecedors', 'FornecedorController'); // CRUD
    $this->get('fornecedors/{id}/compras', 'FornecedorController@compras'); // RELACIONAMENTO 1:M, CONSULTA
    $this->get('fornecedors/{id}/materials', 'FornecedorController@materials'); // RELACIONAMENTO 1:N, CONSULTA.

    $this->apiResource('filial_materials', 'FilialMaterialController'); // CRUD
    $this->delete('filial_materials/{filial_id}/{material_sku}', 'FilialMaterialController@destroyUm'); // APAGA UM REGISTRO DO ESTOQUE!
    $this->get('filial_materials/{filial_id}/{material_sku}', 'FilialMaterialController@showUm'); // RETORNA UM REGISTRO DO ESTOQUE!

});
