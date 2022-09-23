<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
#####
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;
use Mews\Purifier\Casts\CleanHtmlInput;
use Mews\Purifier\Casts\CleanHtmlOutput;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
        'google_id',
       	'image',
        'gender',
        'notify',
        'phone',
        'birthdate',
        'email_verified_at',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'uuid'=> CleanHtml::class,
        'name'=> CleanHtml::class,
        'email'=> CleanHtml::class,
        'password'=> CleanHtml::class,
        'google_id'=> CleanHtml::class,
        'image'=> CleanHtml::class,
        'gender'=> CleanHtml::class,
        'notify'=> CleanHtml::class,
        'phone'=> CleanHtml::class,
        'birthdate'=> CleanHtml::class,
        'email_verified_at'=> CleanHtml::class,
        'email_verified_at' => 'datetime',
        'remember_token'=> CleanHtml::class,
    ];
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function reels()
    {
        return $this->belongsToMany(Reel::class);
    }
    public function comments()
    {
        return $this->belongsToMany(Comments::class);
    }
    public function roles() {
        return $this->belongsToMany(Role::class, 'role_users');
    }


    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
    }


}
