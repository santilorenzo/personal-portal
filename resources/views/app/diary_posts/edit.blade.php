@extends('layouts.app')

@section('content')
  <div class="container admin-page-container">
    @include('app.components.page_header', [
      'title' => 'Modifica post diario', 
      'subtitle' => 'Modifica un post diario esistente.',
      'actions' => [
        [
          'type' => 'link',
          'label' => 'Torna al diario',
          'route' => route('diary_posts.index'),
        ],
        [
          'type' => 'delete',
          'label' => 'Elimina',
          'route' => route('diary_posts.destroy', $diaryPost),
        ],
      ],
    ])

    @include('app.diary_posts.form', ['action' => route('diary_posts.update', $diaryPost), 'method' => 'PUT', 'diaryPost' => $diaryPost])
  </div>
@endsection
