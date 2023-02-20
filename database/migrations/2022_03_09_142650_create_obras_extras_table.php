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
        Schema::create('obras_extras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('bitacora');
            $table->unsignedBigInteger('contrato_id');
            $table->foreign('contrato_id')->references('id')->on('contratos');
            $table->decimal('presupuesto', 18, 2);
            $table->decimal('monto_original', 18, 2);
            $table->tinyInteger('aprobacion')->default(0);
            $table->date('primera_firma')->nullable();
            $table->date('firmas_completas')->nullable();
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
        Schema::dropIfExists('obras_extras');
    }
};
