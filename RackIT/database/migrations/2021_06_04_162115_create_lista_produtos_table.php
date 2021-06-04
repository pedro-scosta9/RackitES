<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamps();
        });

        Schema::create('users_has_listaProdutos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('lista_produtos_id');
            
            //Chave estrangeira users_id
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');

            //Chave estrangeira lista_produtos_id
            $table->foreign('lista_produtos_id')->references('id')->on('lista_produtos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_has_listaProdutos');
        Schema::dropIfExists('lista_produtos');
    }
}
