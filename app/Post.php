<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = []; // this means laravel doesn't have to guard against manually input fields
    // avoids fillable property to allow mass assignment error

    // this function means every post only has 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
