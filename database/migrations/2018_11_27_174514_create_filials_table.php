<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilialsTable extends Migration
{
    public function up()
    {
        Schema::create('filials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razao_social', 100)->unique();
            $table->string('cnpj', 20)->unique();
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
        Schema::dropIfExists('filials');
    }
}
