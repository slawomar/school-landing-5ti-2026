@extends('layouts.public')

@section('title', 'Edytuj artykuł')

@section('content')
    <div class="container my-4">
        <h1>Edytuj artykuł</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('articles.update', $article->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="title">Tytuł</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $article->title) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="category">Kategoria</label>
                <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $article->category) }}">
            </div>

            <div class="form-group mb-3">
                <label for="description">Opis</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $article->description) }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="content">Treść</label>
                <textarea class="form-control" id="content" name="content" rows="12">{{ old('content', $article->content) }}</textarea>
            </div>

            <div class="form-group mb-3">
        <label for="thumbnail">Miniatura</label>
        @if($article->thumbnail)
            <div class="mb-2">
                <small class="text-muted">Aktualna miniatura:</small><br>
                <img src="{{ asset($article->thumbnail) }}" alt="Miniatura" style="max-height: 100px;">
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remove_thumbnail" id="remove_thumbnail" value="1">
                <label class="form-check-label text-danger" for="remove_thumbnail">
                    Usuń aktualną miniaturkę
                </label>
            </div>
            </div>
        @endif
        <input type="file" class="form-control" id="thumbnail" name="thumbnail">
    </div>

            <button type="submit" class="btn btn-warning">Zapisz zmiany</button>
            <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-secondary">Anuluj</a>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '#content', // Podpina się pod textarea z id="content"
    language: 'pl',
    height: 500,
    menubar: false,
    plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code insertdatetime media table code help wordcount',
    toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | removeformat code',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
  });
</script>
@endsection