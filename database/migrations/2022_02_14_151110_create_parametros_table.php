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
        Schema::create('parametros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('logotipo')->default('img/logo2.png');
            $table->string('icono')->default('favicons/favicon.ico');
            $table->string('email_smtp');
            $table->string('email_cuenta');
            $table->string('email_password');
            $table->boolean('email_ssl');
            $table->integer('email_puerto');
            $table->string('email_notificaciones');
            $table->text('lic');
            $table->string('whatsapp_api_key');
            $table->string('whatsapp_api_secret');
            $table->string('whatsapp_account');
            $table->smallInteger('whatsapp_dias_valido');
            $table->string('sms_account');
            $table->string('medio');
            $table->string('host_app');
            $table->string('presupuesto');
            $table->string('siroc');
            $table->string('contrato');
            $table->decimal('iva', 5, 2)->default(16);
            $table->text('dominio_alta_presupuesto')->nullable();
            $table->text('dominio_modificado_presupuesto')->nullable();
            $table->text('dominio_autorizado_presupuesto')->nullable();
            $table->text('dominio_rechazado_presupuesto')->nullable();
            $table->text('dominio_siroc')->nullable();
            $table->text('dominio_jornales')->nullable();
            $table->text('dominio_estimaciones')->nullable();
            $table->text('dominio_estimaciones_cliente')->nullable();
            $table->text('dominio_estimaciones_pendiente')->nullable();
            $table->text('dominio_expedientes')->nullable();
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
        Schema::dropIfExists('parametros');
    }
};
