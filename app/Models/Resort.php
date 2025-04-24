<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resort extends Model
{
    protected $guarded = [];

    protected $casts = [
        'images' => 'array', // Cast JSON to array
        'public_images' => 'array', // Cast JSON to array
    ];
    
}
