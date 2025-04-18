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
        Schema::create('destination_galleries', function (Blueprint $table) {
            $table->id();
            $table->enum('domestic_or_international', ['domestic', 'international']);
            $table->string('destination');
            $table->string('gallery_type')->nullable();
            $table->json('images')->nullable();
            $table->json('public_images')->default('[]');
            $table->enum('visibility', ['private', 'public'])->default('private');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_galleries');
    }
};
