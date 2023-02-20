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
        Schema::create('destajo_obras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('control_id')->constrained('control_obras');
            $table->decimal('cantidad', 18, 2);
            $table->decimal('importe', 18, 2);
            $table->decimal('importe_iva', 18, 2);
            $table->integer('estimacion');
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
        Schema::dropIfExists('destajo_obras');
    }
};
