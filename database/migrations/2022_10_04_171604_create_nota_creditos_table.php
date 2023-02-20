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
        Schema::create('nota_creditos', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->string('emisor');
            $table->foreignId('cliente_id')->constrained();
            $table->foreignId('estimacion_id')->nullable()->constrained('estimaciones');
            $table->string('folio');
            $table->timestamp('fecha');
            $table->decimal('monto', 18, 2);
            $table->text('pdf');
            $table->text('xml');
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
        Schema::dropIfExists('nota_creditos');
    }
};
