<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class FeaturedController extends Controllers
{
    public function __construct()
    {
        $this -> middleware('auth');
    }

    // should we reference profile or user to get user's profile image?
    public function index()
    {
        // here is where we will display the list of featured users
    }
}