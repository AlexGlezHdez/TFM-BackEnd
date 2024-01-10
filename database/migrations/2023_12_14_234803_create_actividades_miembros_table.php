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
        Schema::create('actividad_usuario', function (Blueprint $table) {
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_actividad_agendada');

            $table->timestamps();

            $table->foreign('id_actividad_agendada')->references('id')->on('calendario_actividades');
            // ->onDelete('cascade')
            $table->foreign('id_usuario')->references('id')->on('users');
            // ->onDelete('cascade')

            $table->unique(['id_actividad_agendada', 'id_usuario']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actividad_usuario');
    }
};