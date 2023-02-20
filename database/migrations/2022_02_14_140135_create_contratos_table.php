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
        Schema::create('contratos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uid')->unique();
            $table->string('folio')->unique()->index();
            $table->string('tipo');
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->date('fecha_firma')->index();
            $table->date('fecha_inicio');
            $table->date('fecha_cierre_siroc')->nullable();
            $table->date('fecha_termino');
            $table->decimal('monto_anticipo', 18, 2);
            $table->decimal('importe_contratado', 18, 2);
            $table->decimal('suministros', 18, 2);
            $table->decimal('total_contrato', 18, 2);
            $table->decimal('porcentaje_amortizacion_anticipo', 18, 2)->default(3);
            $table->decimal('porcentaje_retencion', 18, 2)->default(3);
            $table->text('concepto_adenda');
            $table->text('descripcion_contrato');
            $table->string('licencia');
            $table->string('calle');
            $table->string('no_ext');
            $table->string('no_int')->nullable();
            $table->string('localidad');
            $table->string('referencia')->nullable();
            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->unsignedBigInteger('municipio_id');
            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->unsignedBigInteger('codigo_postal');
            $table->string('colonia');
            $table->boolean('permite_deductivas')->default(0);
            $table->boolean('permite_aditivas')->default(0);
            $table->string('documento_partidas')->nullable();
            $table->boolean('estado_partidas')->default(0);
            $table->bigInteger('model_id')->nullable();
            $table->string("model_type")->nullable();
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
        Schema::dropIfExists('contratos');
    }
};
