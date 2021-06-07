<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoprodutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_produtos', function (Blueprint $table) {
            $table->id();
            $table-> date('dataCompra') ->nullable();
            $table-> date('dataValidade') ->nullable();
            $table->decimal('precoCompra') ->nullable();
            $table->decimal('precoNormal') ->nullable();
            $table-> unsignedBigInteger('produtosID');
            $table->foreign('produtosID')->references('id')->on('produtos')->onDelete('cascade');
            $table-> unsignedBigInteger('armazemID');
            $table->foreign('armazemID')->references('id')->on('armazens')->onDelete('cascade');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_produtos');
    }
}
