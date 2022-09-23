<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;

class RoleUser extends Model
{
    use HasFactory;
    protected $fillable =[
        'role_id',
        'user_id',
    ];
    protected $casts = [
        'role_id'=> CleanHtml::class,
        'user_id'=> CleanHtml::class,

    ];
}
