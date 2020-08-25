@extends('layouts.base')

@section('content')
<div class="container">
    @if(session('tag_error'))
    <div class="alert alert-danger">
        {{session('tag_error')}}
    </div>
    @endif
    <form action="/blogs" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            @csrf
            <label>Title:</label>
            <input type="text" class="form-control @error('title_blog') is-invalid @enderror" name="title_blog"
                data-toggle="tooltip" title="Title" value="{{old('title_blog')}}"><br>
            @error('title_blog')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Body:</label>
            <textarea name="content_blog" id="" class="form-control @error('content_blog') is-invalid @enderror" cols="40" rows="8">{{old('content_blog')}}</textarea><br>
            @error('content_blog')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div id="tag_wrapper">
            <label for="tags">Tag:</label>
            <div id="add_tag">Add Tag</div>
            <select name="tags[]" id="tag_select">
                <option value="0">Tidak Ada</option>
                @foreach ($tags as $tag)
                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
            <script src="{{asset('js/tag.js')}}"></script>
        </div>
        <div class="form-group mt-2">
            <label>Thumbnail</label>
            <input type="file" name="thumbnail_blog">
            @if ($errors->has('thumbnail_blog'))
                <div class="alert alert-danger">{{$errors->first('thumbnail_blog')}}</div>
            @endif
            <br>
            <button type="submit" class="btn btn-primary btn-block mt-2">Submit</button>
        </div>
    </form>
</div>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'content_blog' );
</script>
@endsection