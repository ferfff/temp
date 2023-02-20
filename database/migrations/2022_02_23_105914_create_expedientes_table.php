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
        Schema::create('expedientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->string('nombre');
            $table->string('extension');
            $table->text('ruta');
            $table->text('comentario');
            $table->unsignedSmallInteger('condicion_id');
            $table->foreign('condicion_id')->references('id')->on('condiciones');
            $table->unsignedBigInteger('documento_id');
            $table->foreign('documento_id')->references('id')->on('definicion_documentos');
            $table->unsignedBigInteger('contrato_id');
            $table->foreign('contrato_id')->references('id')->on('contratos');
            $table->smallInteger('grupo')->default(1);
            $table->date('seguimiento')->nullable();
            $table->date('aplazamiento')->nullable();
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
        Schema::dropIfExists('archivos');
    }
};
