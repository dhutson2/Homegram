<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    // this middleware function authenticates user before anything below it can be done
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(2);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required','image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public'); //second argument is where to store upload
        // can use s3 instead of public to store in amazon DB if using AWS
        
        // this make function will wrap our image around the imported Image class so we can manipulate it
        // fit function takes 2 arguments, first to set height of image 2nd to set width of img
        // this is in px
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        // auth function lets you get a validated user
        // user() lets you go into that users model
        // posts() lets you create a post into that user using data and will automaticall add user_id
        // this avoids integrity contraint null error ref user_id
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);
        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Post $post)
    {
        // dd($post); // dd is a good way to test if your route works before you create view
        return view('posts.show', compact('post'));
    }
}
