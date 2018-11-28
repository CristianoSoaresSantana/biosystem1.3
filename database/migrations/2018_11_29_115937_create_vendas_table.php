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

            // relacionamentos
            $table->unsignedInteger('filial_id');
            $table->foreign('filial_id')->references('id')->on('filials');
            $table->unsignedInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->unsignedInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->float('valor_total');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('material_vendas', function (Blueprint $table) {
            // relacionamentos
            $table->unsignedInteger('venda_id');
            $table->foreign('venda_id')->references('id')->on('vendas')->onDelete('cascade');

            $table->string('material_sku', 20)->unique();
            $table->foreign('material_sku')->references('sku')->on('materials')->onDelete('cascade');

            $table->integer('quantidade');
            $table->string('lote');
            $table->float('valor_unitario');
            $table->float('desconto');
            $table->string('justificativa_desconto');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Esse metodo serve para remover relacionamentos entre tabelas!
		Schema::table('nomeDaTabela', function(Blueprint $table){

		});
        Schema::dropIfExists('vendas');
    }
}
