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
        Schema::create('archivos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('documento');
            $table->smallInteger('tipo_id')->default(1)->unsigned();
            $table->foreign('tipo_id')->references('id')->on('tipos');
            $table->unsignedBigInteger('obra_extra_id');
            $table->foreign('obra_extra_id')->references('id')->on('obras_extras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archivos');
    }
};
