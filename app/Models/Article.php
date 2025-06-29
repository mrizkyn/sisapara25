<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'user_id'
    ];

    public $timestamps = true;

    protected static function booted()
    {
        static::creating(function ($article) {
            $article->slug = static::generateSlug($article->title);
        });

        static::updating(function ($article) {
            $article->slug = static::generateSlug($article->title);
        });
    }

    protected static function generateSlug($title)
    {
        return Str::slug($title) . '-' . uniqid();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
