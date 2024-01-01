@extends('layouts.app')

@section('content')
<style>
  @import url('https://fonts.googleapis.com/css2?family=Lora&display=swap');
  body, h1, h2, h3, h4, h5, h6, p, a, li, td, th, tr {
    font-family: 'Lora', serif;
  }
  .container {
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
  }
  .footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    padding: 20px;
  }
</style>
<div class="container">
  <div class="row">
    <div class="col-md-12">
    <h1 class="post-title">{{ $diaryPost->title }}</h1>
    <div class="post-date">
      {{ $diaryPost->created_at->format('d/m/Y') }}
    </div>
    <div class="post-body">
      {!! $diaryPost->body !!}
    </div>
    </div>
  </div>
  <div class="footer"> <!-- Add this section -->
    <div class="row mt-3">
      <div class="col-md-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('diary_posts.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('diary_posts.show', $diaryPost) }}">{{ $diaryPost->title }}</a></li>
          </ol>
        </nav>
      </div>
    </div>
  </div> <!-- End of footer section -->
</div>
@endsection
