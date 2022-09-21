<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
