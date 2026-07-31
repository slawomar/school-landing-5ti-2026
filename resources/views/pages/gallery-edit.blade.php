
 @extends('layouts.public')

@section('title', 'Edytuj album: ' . $label)

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edycja albumu / labela: <strong>{{ $label }}</strong></h4>
                    
                    <form action="{{ route('gallery.destroy', $slug) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz USUNĄĆ CAŁY ALBUM i wszystkie zawarte w nim zdjęcia?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Usuń cały album</button>
                    </form>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('gallery.update', $slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-4">
                            <label for="label" class="form-label font-weight-bold">Nazwa labela (Albumu)</label>
                            <input type="text" class="form-control" id="label" name="label" value="{{ old('label', $label) }}" required>
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label font-weight-bold">Obecne zdjęcia w albumie (Zaznacz zdjęcia, które chcesz usunąć):</label>
                            <div class="row g-3">
                                @foreach($photos as $photo)
                                    <div class="col-6 col-md-3">
                                        <div class="card h-100 p-2 text-center border">
                                            <img src="{{ asset(ltrim($photo->path, '/')) }}" class="img-thumbnail mb-2" style="height: 120px; object-fit: cover;">
                                            <div class="form-check justify-content-center d-flex gap-2">
                                                <input class="form-check-input" type="checkbox" name="delete_photos[]" value="{{ $photo->id }}" id="photo_{{ $photo->id }}">
                                                <label class="form-check-label text-danger small" for="photo_{{ $photo->id }}">
                                                    Usuń plik
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="new_photos" class="form-label font-weight-bold">Dograj nowe zdjęcia do tego albumu</label>
                            <input type="file" class="form-control" id="new_photos" name="new_photos[]" multiple accept="image/*">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/gallery" class="btn btn-outline-secondary">&leftarrow; Powrót</a>
                            <button type="submit" class="btn btn-primary px-4">Zapisz zmiany</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection