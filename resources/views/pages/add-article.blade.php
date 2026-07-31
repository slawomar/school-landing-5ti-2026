@extends('layouts.public')

@section('title', 'Dodaj artykuł')

@section('content')
    <div class="container">
        <h1>Dodaj artykuł</h1>
       <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Tytuł</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="category">Kategoria</label>
                <textarea class="form-control" id="category" name="category"></textarea>
            </div>
            <div class="form-group">
                <label for="description">Opis</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="content">Treść</label>
                <textarea class="form-control" id="content" name="content" rows="12"></textarea>
            </div>
            <div class="form-group">
                <label for="thumbnail">Miniatura</label>
                <input type="file" class="form-control" id="thumbnail" name="thumbnail">
            </div>
            <button type="submit" class="btn btn-primary">Dodaj artykuł</button>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '#content',
    language: 'pl',
    height: 500,
    menubar: false,
    plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code insertdatetime media table code help wordcount',
    toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | removeformat code',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
  });
</script>
@endsection