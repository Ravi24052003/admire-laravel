<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinationImage extends Model
{
    protected $table = 'destination_images';

    protected $guarded = [];

    protected $casts = [
        'images' => 'array', // Cast JSON to array
        'public_images' => 'array', // Cast JSON to array
    ];

    public function itineraries()
{
    return $this->hasMany(Itinerary::class, 'selected_destination');
}
}
