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
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique();
            $table->string('folio')->nullable();
            $table->text('descripcion')->nullable();
            $table->foreignId('cliente_id')->constrained();
            $table->decimal('monto', 18, 2);
            $table->date('fecha_recepcion');
            $table->text('archivo');
            $table->string('estado');
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
        Schema::dropIfExists('presupuestos');
    }
};
