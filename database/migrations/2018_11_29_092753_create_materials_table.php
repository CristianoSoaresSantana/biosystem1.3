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
            $table->unsignedInteger('tipo_material_id');
            $table->unsignedInteger('forma_farmaceutica_id');
            $table->unsignedInteger('fornecedor_id');
            $table->string('cod_barra', 40)->unique();
            $table->text('descricao');
            $table->string('image')->nullable();
            $table->float('valor_compra', 10,2);
            $table->float('valor_revenda', 10,2);
            $table->string('status')->default('ativo');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('fornecedor_id')->references('id')->on('fornecedors')->onDelete('cascade');
            $table->foreign('tipo_material_id')->references('id')->on('tipo_materials')->onDelete('cascade');
            $table->foreign('forma_farmaceutica_id')->references('id')->on('forma_farmaceuticas')->onDelete('cascade');
        });

        Schema::create('filial_materials', function (Blueprint $table) {

            $table->unsignedInteger('filial_id');
            $table->string('material_sku', 20);
            $table->integer('quantidade');
            $table->integer('min');
            $table->integer('max');
            $table->char('curvaABC');
            $table->float('comissao');
            $table->float('valor_venda', 10,2);
            $table->string('status', 50)->default('ativo');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('filial_id')->references('id')->on('filials')->onDelete('cascade');
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
		Schema::table('materials', function(Blueprint $table){

		});
        Schema::dropIfExists('materials');
        Schema::dropIfExists('filial_materials');
    }
}
