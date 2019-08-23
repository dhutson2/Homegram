@extends('layouts.app')

@section('content')
<div class='container'>
    <div class="row">
        <div class='col-8'>
            <img src='/storage/{{$post->image}}' alt='' style='height: 500px; width: 500px'>
        </div>
        <div class='col-4'>
            <div class='d-flex align-items-center'>
                <div class='pr-3'>
                    <img src='{{$post->user->profile->profileImage()}}' alt='' class='rounded-circle w-100' style="max-width: 60px;">
                </div>
                <div>
                    <div class='font-weight-bold'>
                        <a href="/profile/{{$post->user->id}}">
                            <span class='text-dark'>{{$post->user->username}}</span>
                        </a> <span class='pl-2'>|</span>
                        <a href="#" class='pl-3'>Follow</a>
                    </div>
                </div>
            </div>

            <hr>
            <p>
                <span class='font-weight-bold'>
                    <a href="/profile/{{$post->user->id}}">
                        <span class='text-dark'>{{$post->user->username}}</span>
                    </a>
                </span> {{$post->caption}}
            </p>
        </div>
    </div>
</div>
@endsection