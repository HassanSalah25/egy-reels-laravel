<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;

class Comment extends Model
{
    use HasFactory;

    protected $fillable =[
        //'id',
        'reel_id',	'content',

    ];
    protected $casts = [
        'reel_id'=> CleanHtml::class,
        'content'=> CleanHtml::class,

    ];

    /**
     * Get all of the comments for the Comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class,'comment_users');
    }
}
