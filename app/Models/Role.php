<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;

class Role extends Model
{
    use HasFactory;
    protected $fillable =[
        'type',
          ];

    protected $casts = [
        'type'=> CleanHtml::class,

    ];
}
