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
        Schema::create('registros_patronales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('razon_social')->unique()->index();
            $table->string('slug');
            $table->string('razon_comercial')->unique();
            $table->string('RFC')->unique();
            $table->string('registro_patronal_imss');
            $table->string('logotipo')->nullable();
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
        Schema::dropIfExists('registros_patronales');
    }
};
