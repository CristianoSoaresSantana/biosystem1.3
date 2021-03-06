<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('filial_id');
            $table->unsignedInteger('cliente_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('tipo_mov_id');
            $table->float('valor_total', 10,2);
            $table->string('status')->default('aberto');
            $table->float('desconto', 10,2)->nullable();
            $table->float('total_com_desconto', 10,2)->nullable();
            $table->string('justificativa_desconto')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('filial_id')->references('id')->on('filials');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('tipo_mov_id')->references('id')->on('tipo_movimentos')->onDelete('cascade');
        });

        Schema::create('forma_pagto_vendas', function (Blueprint $table) {
            $table->unsignedInteger('venda_id');
            $table->unsignedInteger('forma_pagto_id');
            $table->float('valor', 10,2);
            $table->timestamps();

            $table->foreign('venda_id')->references('id')->on('vendas')->onDelete('cascade');
            $table->foreign('forma_pagto_id')->references('id')->on('forma_pagtos')->onDelete('cascade');
        });

        Schema::create('material_vendas', function (Blueprint $table) {
            $table->unsignedInteger('venda_id');
            $table->string('material_sku', 20);
            $table->integer('quantidade')->nullable();
            $table->integer('quantidade_anterior')->nullable();
            $table->string('lote', 20)->unique();
            $table->float('valor_unitario', 10,2);
            $table->float('desconto')->nullable();
            $table->float('sub_total')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('venda_id')->references('id')->on('vendas')->onDelete('cascade');
            $table->foreign('material_sku')->references('sku')->on('materials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('vendas', function(Blueprint $table){
            // Esse metodo serve para remover relacionamentos entre tabelas!
		});
        Schema::dropIfExists('material_vendas');
        Schema::dropIfExists('vendas');
        Schema::dropIfExists('forma_pagto_vendas');
    }
}
