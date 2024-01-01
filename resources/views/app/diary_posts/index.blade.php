@extends('layouts.app')

@section('content')
<div class="container admin-page-container">
  @include('app.components.page_header', [
    'title' => 'Diario', 
    'subtitle' => 'Gestisci i post del diario.',
    'actions' => [
      [
        'type' => 'link',
        'label' => 'Crea nuovo post',
        'route' => route('diary_posts.create'),
      ],
    ],
  ])
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Titolo</th>
        <th>Creato il</th>
        <th>Azioni</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($diaryPosts as $diaryPost)
      <tr onclick="window.location.href = '{{ route('diary_posts.show', $diaryPost) }}';" style="cursor: pointer">
        <td>{{ $diaryPost->title }}</td>
        <td>{{ $diaryPost->created_at }}</td>
        <td class="d-flex">
          <a href="{{ route('diary_posts.edit', $diaryPost) }}" class="btn btn-primary btn-sm me-1">
            <i class="fa fa-edit"></i>
          </a>
          <form method="POST" action="{{ route('diary_posts.destroy', $diaryPost) }}" class="d-inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
              <i class="fa fa-trash"></i>
            </button>
          </form>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $diaryPosts->links() }}
</div>
@endsection
