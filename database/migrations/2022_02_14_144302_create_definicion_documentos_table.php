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
        Schema::create('definicion_documentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->string('nombre')->unique();
            $table->string('slug');
            $table->boolean('obligatorio')->default(0);
            $table->boolean('solicita_aprobacion')->default(0);
            $table->boolean('solicita_comentario')->default(0);
            $table->unsignedInteger('ciclo_id');
            $table->foreign('ciclo_id')->references('id')->on('ciclo_proyecto');
            $table->boolean('multiple')->default(0);
            $table->boolean('referencia')->default(0);
            $table->boolean('seguimiento')->default(0);
            $table->boolean('aplazamiento')->default(0);
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
        Schema::dropIfExists('definicion_documentos');
    }
};
