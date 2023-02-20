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
        Schema::create('estimaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->foreignId('contrato_id')->constrained();
            $table->date('fecha_estimacion');
            $table->integer('no_estimacion');
            $table->decimal('monto_ejecutar', 18, 2);
            $table->decimal('monto_facturar', 18, 2);
            $table->decimal('retencion_monto', 18, 2);
            $table->decimal('retencion_porcentaje', 5, 2);
            $table->decimal('total_facturar', 18, 2);
            $table->decimal('amortizacion_monto', 18, 2);
            $table->decimal('amortizacion_porcentaje', 5, 2);
            $table->string('estado');
            $table->longText('comentario')->nullable();
            $table->date('fecha_pago')->nullable();
            $table->string('complemento_pago')->nullable();
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
        Schema::dropIfExists('estimaciones');
    }
};
