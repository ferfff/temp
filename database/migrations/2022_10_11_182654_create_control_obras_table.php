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
        Schema::create('control_obras', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->uuid('uuid');
            $table->text('hash');
            $table->string('clave');
            $table->text('partida');
            $table->string('unidad');
            $table->decimal('cantidad', 18, 2);
            $table->decimal('precio_unitario', 18, 2);
            $table->string('grupo');
            $table->integer('codigo_grupo');
            $table->decimal('importe', 18, 2);
            $table->foreignId('contrato_id')->constrained();
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
        Schema::dropIfExists('control_obras');
    }
};
