<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class FeaturedController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth');
    }

    public function index(\App\Post $posts)
    {
        $posts = user()->posts()->image;

        return view('profiles.featured', compact('posts'));
    }
}