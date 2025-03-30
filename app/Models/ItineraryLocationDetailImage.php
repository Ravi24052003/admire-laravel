<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItineraryLocationDetailImage extends Model
{

    protected $table = 'itinerary_location_detail_images';

    protected $guarded = [];

    protected $casts = [
        'images' => 'array', // Cast JSON to array
    ];
}
