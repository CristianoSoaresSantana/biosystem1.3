<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->string('sku', 20)->primary();
            $table->string('cod_barra', 40)->unique();
            $table->string('descricao', 100);
            $table->float('valor_compra');
            $table->float('valor_revenda');
            

            // relacionamentos
            $table->unsignedInteger('tipo_material_id');
            $table->foreign('tipo_material_id')->references('id')->on('tipo_materials')->onDelete('cascade');
            $table->unsignedInteger('forma_farmaceutica_id');
            $table->foreign('forma_farmaceutica_id')->references('id')->on('forma_farmaceuticas')->onDelete('cascade');
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('filial_materials', function (Blueprint $table) {
            // relacionamentos
            $table->unsignedInteger('filial_id');
            $table->foreign('filial_id')->references('id')->on('filials')->onDelete('cascade');

            $table->string('material_sku', 20)->unique();
            $table->foreign('material_sku')->references('sku')->on('materials')->onDelete('cascade');
            
            $table->integer('quantidade');
            $table->integer('min');
            $table->integer('max');
            $table->char('curvaABC');
            $table->float('comissao');
            $table->float('valor_venda');
            $table->string('status', 50)->default('ativo');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('fornecedor_materials', function (Blueprint $table) {
            // relacionamentos
            $table->unsignedInteger('fornecedor_id');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedors')->onDelete('cascade');

            $table->string('material_sku', 20)->unique();
            $table->foreign('material_sku')->references('sku')->on('materials')->onDelete('cascade');
            $table->string('status', 50)->default('ativo');
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
        Schema::dropIfExists('materials');
        Schema::dropIfExists('fornecedors_materials');
        Schema::dropIfExists('filial_materials');
    }
}
