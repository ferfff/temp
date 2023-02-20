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
        Schema::create('post_ventas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('contrato_id')->constrained();
            $table->decimal('monto', 18, 2);
            $table->date('fecha_recepcion');
            $table->text('archivo');
            $table->boolean('estado');
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
        Schema::dropIfExists('post_ventas');
    }
};
