@extends('layouts.base')

@section('content')
  <div class="container">
    <form action="/blog/{{$blog->id}}" method="POST">
        <div class="form-group">
          @csrf
          @method('PUT')
          <label>Title</label>
          <input type="text" name="title_blog" class="form-control" value="{{$blog->title_blog}}">
            @if ($errors->has('title_blog'))
              <p>{{$errors->first('title_blog')}}</p>
            @endif
        </div>
        <div class="form-group">
          <label>Body</label>
          <textarea name="content_blog" id="" cols="40" class="form-control" rows="8">{{$blog->content_blog}}</textarea>
            @if ($errors->has('content_blog'))
              <p>{{$errors->first('content_blog')}}</p>
            @endif<br>
        {{-- <div id="tag_wrapper">
          <label for="tags">Tag:</label>
          <div id="add_tag">Add Tag</div>
          @foreach ($blog->tags as $oldtags)
            <select name="tags[]" id="tag_select">
                <option value="0">Tidak Ada</option>
                @foreach ($tags as $tag)
                    <option value="{{$tag->id}}" 
                      @if ($oldtags->id == $tag->id)
                        selected="selected"
                      @endif
                      >{{$tag->name}}</option>
                @endforeach
            </select>   
          @endforeach
          <script src="{{asset('js/tag.js')}}"></script> --}}
        </div>
          <input type="submit" value="Update" class="btn btn-primary btn-block mt-2">
      </div>
    </form>
  </div>
  <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'content_blog' );
</script>
@endsection