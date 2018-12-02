<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->string('num_doc', 20)->primary();
            $table->unsignedInteger('filial_id');
            $table->unsignedInteger('tipo_mov_id');
            $table->unsignedInteger('fornecedor_id');
            $table->float('valor_nota');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('fornecedor_id')->references('id')->on('fornecedors')->onDelete('cascade');
            $table->foreign('filial_id')->references('id')->on('filials')->onDelete('cascade');
            $table->foreign('tipo_mov_id')->references('id')->on('tipo_movimentos')->onDelete('cascade');
        });

        Schema::create('compra_materials', function (Blueprint $table) {
            $table->string('lote', 20)->unique();
            $table->string('compra_num_doc', 20);
            $table->string('material_sku', 20);
            $table->integer('quantidade');
            $table->float('valor_unitario');
            $table->date('data_fabricacao');
            $table->date('data_vencimento');            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('compra_num_doc')->references('num_doc')->on('compras')->onDelete('cascade');
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
        // Esse metodo serve para remover relacionamentos entre tabelas!
		Schema::table('compras', function(Blueprint $table){

		});
        Schema::dropIfExists('compras');
    }
}
