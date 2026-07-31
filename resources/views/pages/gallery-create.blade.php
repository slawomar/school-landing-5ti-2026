@extends('layouts.public')

@section('title', 'Dodaj nowy label w galerii')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Dodaj nowy label / album do galerii</h4>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="label" class="form-label font-weight-bold">Nazwa labela (Albumu) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="label" name="label" value="{{ old('label') }}" placeholder="np. Dni Otwarte 2026" required>
                            <small class="form-text text-muted">Będzie to etykieta, pod którą w galerii będą grupowane te zdjęcia.</small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="description" class="form-label font-weight-bold">Opis (opcjonalny)</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Krótki opis do zdjęć...">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label for="photos" class="form-label font-weight-bold">Zdjęcia <span class="text-danger">* (Min. 1 zdjęcie)</span></label>
                            <input type="file" class="form-control" id="photos" name="photos[]" multiple accept="image/*" required>
                            <small class="form-text text-muted">Możesz zaznaczyć jedno lub wiele zdjęć jednocześnie na raz.</small>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="/galeria" class="btn btn-outline-secondary">&leftarrow; Anuluj</a>
                            <button type="submit" class="btn btn-success px-4">Dodaj do galerii</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection