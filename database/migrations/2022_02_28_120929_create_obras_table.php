<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('registro_patronal_id');
            $table->foreign('registro_patronal_id')->references('id')->on('registros_patronales');
            $table->string('clave_obra')->index();
            $table->string('slug')->index();
            $table->string('nombre')->index();
            $table->string('etapa');
            $table->string('residente');
            $table->string('presupuesto');
            $table->string('direccion');
            $table->date('fecha_inicio');
            $table->date('fecha_termino');
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
        Schema::dropIfExists('obras');
    }
};
