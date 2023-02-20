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
        Schema::create('factores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('SDI', 8, 2);
            $table->decimal('SD', 8, 2);
            $table->decimal('salario', 8, 2);
            $table->decimal('puntualidad', 8, 2);
            $table->decimal('asistencia', 8, 2);
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
        Schema::dropIfExists('factores');
    }
};
