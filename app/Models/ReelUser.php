<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReelUser extends Model
{
    use HasFactory;
    protected $fillable =[
        'reel_id',
        'user_id',
    ];
}