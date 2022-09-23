<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;

class VerifyUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'token'
    ];
    ####################
//    protected $casts = [
//        'token'=> CleanHtml::class,
//        'user_id'=> CleanHtml::class,
//
//    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
