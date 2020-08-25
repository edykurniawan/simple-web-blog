@extends('layouts.base')
@section('content')

<div class="container">
  <main>
      <section class="landing justify-content-center">
        <div class="intro">
          <h1 class="judul text-center">About</h1>
          <img src="img/profile.jpg" class="avatar mx-auto d-block" alt="edykn">
          <h2 class="text-center">Edy KN</h2>
          <p class="text-center">Student | Web Developer | Youtuber <br /></p>
          <div class="social text-center">
            <a href="https://facebook.com/edykn21" class="fa fa-facebook"></a>
            <a href="https://twitter.com/runyde" class="fa fa-twitter"></a>
            <a href="https://instagram.com/runydek" class="fa fa-instagram"></a>
            <a href="https://youtube.com/channel/UCZ5TnFiMUCSSgZ9hFPCFtkw" class="fa fa-youtube"></a>
            <a href="#" class="fa fa-google"></a>
          </div>
        </section>
        <hr>
        <section>
         <h1 class="judul text-center"><a href="/blogs">Latest Posts</a></h1>      <ul class="list-blog mt-3">
            @foreach ($lists as $list)
              <li><a href="{{route('show', $list->slug)}}">{{ ucfirst($list->title_blog) }}</a></li>
              </a>
            @endforeach
          </ul>
    </section>
      <hr />
  </main>
</div>

@endsection