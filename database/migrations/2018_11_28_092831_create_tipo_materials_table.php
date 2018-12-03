<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_material', 50);
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
		Schema::table('tipo_materials', function(Blueprint $table){

		});
        Schema::dropIfExists('tipo_materials');
    }
}
