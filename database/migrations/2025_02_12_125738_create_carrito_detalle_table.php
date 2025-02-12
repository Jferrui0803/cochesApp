<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('carritodetalle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carrito_id');
            $table->foreignId('coche_id');
            $table->integer('cantidad');
            $table->foreign('carrito_id')->references('id')->on('carrito')->onDelete('cascade');
            $table->foreign('coche_id')->references('id')->on('coche')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['carrito_id', 'coche_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrito_detalle');
    }
};
