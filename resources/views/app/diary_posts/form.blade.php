<form action="{{ $action }}" method="POST">
  @csrf
  @method($method)

  <div class="row gy-3">
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" name="title" id="title" class="form-control" value="{{ old('title', !empty($diaryPost) ? $diaryPost->title : '') }}" required>
    </div>

    <div class="form-group">
      <label for="published_at">Published At</label>
      <input type="date" name="published_at" id="published_at" class="form-control" value="{{ old('published_at', !empty($diaryPost->published_at) ? $diaryPost->published_at->format('Y-m-d') : '') }}">
    </div>

    <div class="form-group">
      <label for="body">Corpo</label>
      <input id="x" type="hidden" name="body" value="{{ old('body', !empty($diaryPost) ? $diaryPost->body : '') }}">
      <trix-editor input="x"></trix-editor>
    </div>

    <button type="submit" class="btn btn-primary mt-1">Save</button>
  </div>
</form>
<script>
  // Add the trix editor

