<div class="d-flex align-items-center justify-content-between">
  <h1>{{ $title }}</h1>
  <div class="flex">
    @foreach ($actions as $action)
      @if ($action['type'] === 'link')
        <a href="{{ $action['route'] }}" class="btn btn-primary ml-3">{{ $action['label'] }}</a>
      @elseif ($action['type'] === 'delete')
        <form method="POST" action="{{ $action['route'] }}" class="d-inline-block">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger ml-3">{{ $action['label'] }}</button>
        </form>
      @endif
    @endforeach
  </div>
</div>