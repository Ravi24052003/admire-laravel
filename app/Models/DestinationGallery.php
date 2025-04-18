<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinationGallery extends Model
{

    protected $table = 'destination_galleries';

    protected $guarded = [];
    
    protected $casts = [
        'images' => 'array',
        'public_images' => 'array',
    ];
}
