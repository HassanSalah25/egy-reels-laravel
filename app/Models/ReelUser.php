<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;

class ReelUser extends Model
{
    use HasFactory;
    protected $fillable =[
        'reel_id',
        'user_id',
    ];
    protected $casts = [
        'reel_id'=> CleanHtml::class,
        'user_id'=> CleanHtml::class,

    ];

}
