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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('blog_title');
            $table->string('blog_slug')->unique();
           
            $table->text('blog_description');
            $table->string('blog_author_name')->nullable();
            $table->string('blog_category');
            
            $table->string('blog_visibility')->default('public');
            $table->longText('blog_content');

            $table->string('blog_image');
            $table->string('blog_image_alt_text');
            $table->json('blog_images')->nullable();

            $table->string('blog_meta_title');
            $table->text('blog_meta_description');
            $table->string('blog_meta_keywords');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
