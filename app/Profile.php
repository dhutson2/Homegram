<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : 'profile/jRNhxGAs8chzl2d0YrEQnEjR9DQLYtf5jro4B9z4.png';
        return '/storage/' . $imagePath;
    }

    public function followers() // this means a user can have many followers
    {
        return $this->belongsToMany(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
