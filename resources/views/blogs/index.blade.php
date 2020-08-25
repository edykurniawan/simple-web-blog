@extends('layouts.base')

@section('content')
<div class="container">
    Filter Tag:
    @foreach ($tags as $tag)
        <a class="badge badge-pill badge-primary" href="/blogs/filter/{{$tag->name}}">{{$tag->name}}</a>
    @endforeach

    @auth
    <a class="btn btn-light mb-2" href="/blog/create">+ Post</a> 
    @endauth
    {{-- <div class="md-form active-cyan-2 mb-3">
        <form action="/blogs" method="get">
            <input class="form-control" type="text" placeholder="Search" aria-label="Search" name="search">
        </form>
    </div> --}}
    @foreach ($blogs as $blog)
    <div class="card mb-2 mt-2">
        <div class="card-body">
            <ul class="blog-list">
                <h1><li><a href="/blog/{{$blog->slug}}">{{$blog->title_blog}}</a></li></h1>
                <small>Created At {{$blog->created_at}}</small><br>
                @if(count($blog->tags) > 0)
                <small> tag : 
                @foreach ($blog->tags as $tag)
                    <span class="badge badge-pill badge-primary">{{$tag->name}}</span>
                @endforeach
                </small>
                @endif
                @auth
                    <form action="/blog/{{$blog->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" name="submit" value="delete">
                    </form>
                @endauth
            </ul>
        </div>
    </div>        
    @endforeach
    {{-- {{$blogs->links()}} --}}
</div>    
@endsection