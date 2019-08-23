<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // boot function will trigger an event after another event happens
    // EX: when new user registers, auto make a profile for them
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            // this is called a closure
            $user->profile()->create([
                'title' => $user->username,
            ]);

            // insert mail trap here to send auto emails
        });
    }

    // this function means that this user has many posts
    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function following() // this means a user can follow many profiles
    {
        return $this->belongsToMany(Profile::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
