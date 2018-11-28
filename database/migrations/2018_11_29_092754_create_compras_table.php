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
            $table->string('num_doc', 20)->unique();

            // relacionamentos
            $table->unsignedInteger('filial_id');
            $table->foreign('filial_id')->references('id')->on('filials')->onDelete('cascade');
            $table->unsignedInteger('fornecedor_id');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedors')->onDelete('cascade');
            $table->float('valor_nota');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('compra_materials', function (Blueprint $table) {
            // relacionamentos
            $table->string('compra_num_doc', 20)->unique();
            $table->foreign('compra_num_doc')->references('num_doc')->on('compras')->onDelete('cascade');

            $table->string('material_sku', 20)->unique();
            $table->foreign('material_sku')->references('sku')->on('materials')->onDelete('cascade');

            $table->integer('quantidade');
            $table->float('valor_unitario');
            $table->string('lote');
            $table->date('data_fabricacao');
            $table->date('data_vencimento');

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
        Schema::dropIfExists('compras');
    }
}
