<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;

class Following extends Model
{
    use HasFactory;
    protected $casts = [
         'user_id'=> CleanHtml::class,
        'fuser_id'=> CleanHtml::class,

    ];
}
