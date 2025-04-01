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
        Schema::create('image_and_text_testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('rating')->unsigned(); // 1-5
            $table->text('text'); 
            $table->enum('visibility', ['private', 'public'])->default('private');
            $table->string('image'); // single mandatory image path
            $table->json('images')->nullable(); // optional multiple images
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_and_text_testimonials');
    }
};
