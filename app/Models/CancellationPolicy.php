<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CancellationPolicy extends Model
{
    protected $table = 'cancellation_policies';

    protected $fillable = [
        'cancellation_policy',
    ];
}
