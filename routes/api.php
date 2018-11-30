<?php

use Illuminate\Http\Request;

// //Rotas manuais para o CRUD filials
// $this->get('filials', 'Api\FilialController@index');
// $this->post('filials', 'Api\FilialController@store');
// $this->put('filials/{id}', 'Api\FilialController@update');
// $this->delete('filials/{id}', 'Api\FilialController@delete');

$this->apiResource('filials', 'Api\FilialController');

$this->apiResource('materials', 'Api\MaterialController');