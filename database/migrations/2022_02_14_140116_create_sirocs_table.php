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
        Schema::create('sirocs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique();
            $table->string('folio')->nullable();
            $table->text('descripcion')->nullable();
            $table->foreignId('cliente_id')->constrained();
            $table->foreignId('presupuesto_id')->nullable()->constrained();
            $table->string('imss');
            $table->text('archivo');
            $table->date('fecha_firma')->index();
            $table->date('fecha_cierre_siroc')->nullable();
            $table->string('estado')->default('Aprobado');
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
        Schema::dropIfExists('sirocs');
    }
};
