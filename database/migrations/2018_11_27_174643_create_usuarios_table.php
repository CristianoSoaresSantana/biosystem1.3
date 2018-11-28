<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            // relacionamentos
            $table->unsignedInteger('filial_id');
            $table->foreign('filial_id')->references('id')->on('filials')->onDelete('cascade');
            $table->unsignedInteger('setor_id');
            $table->foreign('setor_id')->references('id')->on('setors')->onDelete('cascade');

            $table->string('nome', 100);
            $table->string('cpf', 15)->unique();
            $table->date('data_nascimento');
            $table->string('email', 100)->unique();
            $table->string('senha');
            $table->string('celular', 15)->unique();
            $table->string('status', 15)->default('ativo');
            $table->string('permissao', 15)->default('app.user');
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
		Schema::table('nomeDaTabela', function(Blueprint $table){

		});
        Schema::dropIfExists('usuarios');
    }
}