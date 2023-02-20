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
        Schema::create('estimacion_aditivas', function (Blueprint $table) {
            $table->foreignId('estimacion_id')->constrained('estimaciones');
            $table->string('concepto');
            $table->decimal('cantidad', 18, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimacion_aditivas');
    }
};
