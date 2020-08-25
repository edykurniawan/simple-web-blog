@extends('layouts.base')

@section('content')
<div class="container-blog">
    <h1 class="title">{{$blog->title_blog}}</h1>
    <small>created at {{$blog->created_at}}</small><br>
    <small>Written by : {{$blog->user->name}}</small>
    @if ($blog->thumbnail_blog)
    <hr>
    <div class="box-image">
        <img src="{{asset('storage/blog/'. $blog->thumbnail_blog)}}" alt="{{$blog->title_blog}}">
    </div>
    @endif
    <hr>
    <p class="p-justify">{!!$blog->content_blog!!}</p><br>
    @auth
    <button><a href="{{$blog->id}}/edit">Edit</a></button>
    @endauth
    <button class="back"><a href="/blogs"><i class="fa fa-arrow-left" aria-hidden="true"></i> back</a></button>

</div>
@endsection