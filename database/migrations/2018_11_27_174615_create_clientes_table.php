<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100);
            $table->string('cpf', 15)->unique();
            $table->string('email', 100)->unique();
            $table->string('celular', 15)->unique();
            $table->string('celular_recado', 15);
            $table->text('endereco', 190);
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
		Schema::table('clientes', function(Blueprint $table){

		});
        Schema::dropIfExists('clientes');
    }
}
