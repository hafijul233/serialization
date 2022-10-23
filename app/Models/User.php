<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
/*        'email_verified_at',
        'created_at',
        'updated_at'*/
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*protected $appends = ['verified', 'joined_at', 'photo'];

    public function getVerifiedAttribute()
    {
        return !is_null($this->email_verified_at);
    }

    public function getJoinedAtAttribute()
    {
        return $this->created_at->format('r');
    }

    public function getPhotoAttribute()
    {
        return asset('public/favicon.ico');
    }*/

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
