<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogContentImage extends Model
{
    protected $table = 'blog_content_images';

    protected $guarded = [];

    protected $casts = [
        'images' => 'array',
    ];
}
