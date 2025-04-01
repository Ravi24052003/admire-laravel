<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageAndTextTestimonial extends Model
{
    protected $table = 'image_and_text_testimonials';

    protected $guarded = [];

    protected $casts = [
        'images' => 'array'
    ];
}
