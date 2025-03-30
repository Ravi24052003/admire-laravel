<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SelectedDestinationVideoBanner extends Model
{
    protected $table = 'selected_destination_video_banners';

    protected $fillable = [
        'video_url',
        'destination',
    ];
}
