<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormaFarmaceuticasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forma_farmaceuticas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao', 50);
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
        Schema::dropIfExists('forma_farmaceutica');
    }
}