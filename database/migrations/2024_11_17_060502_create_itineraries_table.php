<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('itineraries', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); //Manual Foreign key
            $table->enum('domestic_or_international', ['domestic', 'international']);
            $table->json('days_information'); // JSON column for days details
            $table->longText('destination_detail'); // Long text for destination detail
            $table->longText('inclusion')->nullable(); // Long text for inclusion
            $table->longText("additional_inclusion")->nullable();
            $table->longText('exclusion')->nullable(); // Long text for exclusion
            $table->longText('tour_highlight')->nullable(); // Long text for exclusion
            $table->longText('terms_and_conditions')->nullable(); // Long text for terms and conditions
            $table->longText('special_note')->nullable();
            $table->longText('cancellation_policy')->nullable();
            $table->longText('payment_mode')->nullable();
            $table->string('pricing')->nullable(); 
            $table->json('hotel_details')->nullable(); // JSON column for hotel details
            $table->string('title'); // Title
            $table->string('slug')->unique(); // Slug
            $table->string('meta_title')->nullable(); // Nullable meta title
            $table->string('keyword')->nullable(); // Nullable keyword
            $table->longText('meta_description')->nullable(); // Nullable meta description
            $table->string('itinerary_visibility'); // Itinerary visibility
            $table->string('itinerary_type'); // Itinerary type
            $table->string('duration'); // String column for duration
            $table->string('selected_destination'); // String column for selected destination
            $table->json('itinerary_theme'); // JSON column for itinerary theme
            $table->json('status_flags')->nullable(); // trending, exclusive and weekend destinations
            $table->string('destination_thumbnail'); // String column for destination thumbnail
            $table->json('destination_images'); // JSON column for destination images
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itineraries');
    }
};
