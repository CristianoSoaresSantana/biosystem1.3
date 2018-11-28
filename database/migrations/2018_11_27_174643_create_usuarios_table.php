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
            $table->string('permissao', 15);
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
        Schema::dropIfExists('usuarios');
    }
}
