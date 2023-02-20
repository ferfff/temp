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
        Schema::create('estimacion_archivo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nombre');
            $table->string('extension');
            $table->string('tipo');
            $table->foreignId('estimacion_id')->constrained('estimaciones');
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
        Schema::dropIfExists('estimacion_archivo');
    }
};
