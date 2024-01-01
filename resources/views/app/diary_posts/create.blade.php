@extends('layouts.app')

@section('content')
  <div class="container admin-page-container">
    @include('app.components.page_header', [
      'title' => 'Crea nuovo post diario', 
      'subtitle' => 'Crea un nuovo post diario.',
      'actions' => [
        [
          'type' => 'link',
          'label' => 'Torna al diario',
          'route' => route('diary_posts.index'),
        ],
      ],
    ])

    @include('app.diary_posts.form', ['action' => route('diary_posts.store'), 'method' => 'POST'])
  </div>
@endsection
