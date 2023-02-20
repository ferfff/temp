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
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('razon_social')->unique()->index();
            $table->string('slug');
            $table->string('RFC')->unique();
            $table->string('contacto');
            $table->string('registro_patronal');
            $table->string('repse');
            $table->boolean('presupuesto');
            $table->boolean('siroc');
            $table->boolean('expediente');
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
        Schema::dropIfExists('clientes');
    }
};
