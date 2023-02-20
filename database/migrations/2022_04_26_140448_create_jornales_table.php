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
        Schema::create('jornales', function (Blueprint $table) {
            $table->id();
            $table->string('NSS');
            $table->string('slug');
            $table->string('nombre_completo');
            $table->string('departamento');
            $table->string('curp');
            $table->string('dias_laborados');
            $table->string('SDI');
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
        Schema::dropIfExists('jornales');
    }
};
