<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;

    protected $primaryKey = 'articlesID';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'body',
        'articles_img',
        'tags',
        'userID',
        'published_on',
        'scheduled_post',
        'is_posted',
        'is_archived',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($article) {
            if ($article->articles_img) {
                Storage::disk('public')->delete($article->articles_img);
            }
        });
    }
}
