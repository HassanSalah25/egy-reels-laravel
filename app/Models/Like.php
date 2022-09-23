<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;

class Like extends Model
{
    use HasFactory;
    protected $fillable =[
        'reel_id',
        'active',
        'user_id',
    ];

    protected $casts = [
        'user_id'=> CleanHtml::class,
        'reel_id'=> CleanHtml::class,
        'active'=> CleanHtml::class,

    ];
}
