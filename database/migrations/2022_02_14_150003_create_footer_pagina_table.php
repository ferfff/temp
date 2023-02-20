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
        Schema::create('footer_pagina', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('aviso_privacidad');
            $table->string('aviso_privacidad_resumen');
            $table->string('ubicacion');
            $table->string('email');
            $table->string('telefono');
            $table->string('facebook_url')->nullable();
            $table->boolean('facebook_activo');
            $table->string('twitter_url')->nullable();
            $table->boolean('twitter_activo');
            $table->string('instagram_url')->nullable();
            $table->boolean('instagram_activo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('footer_pagina');
    }
};
