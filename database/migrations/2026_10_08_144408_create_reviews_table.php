<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');    // Pembeli yang mengulas
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Produk yang diulas
            $table->tinyInteger('rating');                                       // Bintang 1 - 5
            $table->text('comment')->nullable();                                 // Komentar/ulasan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
