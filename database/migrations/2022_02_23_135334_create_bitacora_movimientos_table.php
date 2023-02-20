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
        Schema::create('bitacora_movimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('comentario')->nullable();
            $table->string('user');
            $table->string('accion');
            $table->integer('model_id');
            $table->string("model_type");
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
        Schema::dropIfExists('bitacora_movimientos');
    }
};
