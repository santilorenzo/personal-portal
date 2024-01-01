<form action="{{ $action }}" method="POST">
  @csrf
  @method($method)

  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', !empty($diaryPost) ? $diaryPost->title : '') }}" required>
  </div>

  <div class="form-group">
    <label for="body">Corpo</label>
    <input id="x" type="hidden" name="body" value="{{ old('body', !empty($diaryPost) ? $diaryPost->body : '') }}">
    <trix-editor input="x"></trix-editor>
  </div>

  <button type="submit" class="btn btn-primary mt-1">Save</button>
</form>
<script>
  // Add the trix editor

