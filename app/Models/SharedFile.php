<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharedFile extends Model
{
    protected $fillable = ['file', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
