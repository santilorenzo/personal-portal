@extends('layouts.app')

@section('content')
<style>
  @import url('https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap');
  body, h1, h2, h3, h4, h5, h6, p, a, li, td, th, tr {
    font-family: 'Lora', serif;
  }
  .page.container {
    max-width: 800px;
    padding-top: 50px;
    position: relative;
    min-height: 100vh;
  }
  .post-title {
    font-size: 40px;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center;
  }
  .post-date {
    font-size: 20px;
    margin-bottom: 20px;
    text-align: center;
  }
  .post-body {
    font-size: 20px;
    line-height: 1.5;
    text-align: justify;
    margin-bottom: 50px;
  }
</style>
<div class="page container">
  <div class="row">
    <div class="col-md-12">
    <h1 class="post-title">{{ $diaryPost->title }}</h1>
    <div class="post-date">
      {{ $diaryPost->published_at->format('d/m/Y') }}
    </div>
    <div class="post-body">
      {!! $diaryPost->body !!}
    </div>
    </div>
  </div>

  <footer class="footer bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('diary_posts.index') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('diary_posts.show', $diaryPost) }}">{{ $diaryPost->title }}</a></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </footer>
</div>
@endsection

