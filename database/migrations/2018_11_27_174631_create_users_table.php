<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedInteger('filial_id');
            $table->unsignedInteger('setor_id');
            $table->string('cpf', 15)->unique();
            $table->date('data_nascimento');
            $table->string('celular', 15)->unique();
            $table->string('celular_recado', 15)->unique();
            $table->string('status', 15)->default('ativo');
            $table->string('permissao', 15)->default('app.user');
            $table->text('endereco', 190);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('filial_id')->references('id')->on('filials')->onDelete('cascade');
            $table->foreign('setor_id')->references('id')->on('setors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('usuarios', function(Blueprint $table){
            // Esse metodo serve para remover relacionamentos entre tabelas!
		});
        Schema::dropIfExists('users');
    }
}
