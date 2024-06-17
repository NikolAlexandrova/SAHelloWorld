<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'summary',
        'description',
        'location',
        'allowed_participants',
        'starting_time',
        'ending_time',
        'date',
        'amount',
        'discounted_amount',
    ];
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
