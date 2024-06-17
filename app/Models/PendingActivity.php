<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingActivity extends Model
{
    protected $fillable = [
        'title', 'summary', 'description', 'location', 'allowed_participants', 'starting_time', 'date'
    ];
}
