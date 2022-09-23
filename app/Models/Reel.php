<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;

class Reel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'caption',
        'video_url',
        'likes_count',
        'comments_count',
    ];
    protected $casts = [
        'name'=> CleanHtml::class,
        'caption'=> CleanHtml::class,
        'video_url'=> CleanHtml::class,
        'likes_count'=> CleanHtml::class,
        'comments_count'=> CleanHtml::class,

    ];
/**
 * Get all of the comments for the Reel
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
