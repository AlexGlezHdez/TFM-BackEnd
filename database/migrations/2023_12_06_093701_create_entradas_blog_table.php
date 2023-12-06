<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('entradas_blog', function (Blueprint $table) {
            $table->id();
            $table->string('titulo_entrada');
            $table->string('imagen');
            $table->text('contenido');
            $table->dateTime('fecha_publicacion');
            $table->unsignedBigInteger('id_autor');


            $table->timestamps();
        });
    }

/*    $table->foreign('id_autor')->references('id')->on('autores'); */


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas_blog');
    }
};
