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
        Schema::create('counters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('packages')->default(0);
            $table->unsignedBigInteger('destinations_covered')->default(0);
            $table->integer('years_in_business')->default(0);
            $table->integer('rating')->default(5);
            $table->enum('visibility', ['private', 'public'])->default('private');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counters');
    }
};
