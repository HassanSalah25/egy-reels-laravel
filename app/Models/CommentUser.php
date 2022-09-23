<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;

class CommentUser extends Model
{
    use HasFactory;
    protected $fillable =[
        'comment_id',
        'user_id',
    ];
    protected $casts = [
        'comment_id'=> CleanHtml::class,
        'user_id'=> CleanHtml::class,
        'content'=> CleanHtml::class,

    ];

}
