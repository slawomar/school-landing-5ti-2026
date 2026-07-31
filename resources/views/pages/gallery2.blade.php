@extends('layouts.public')

@section('title', 'Pełna galeria')

@section('body_class', 'gallery-page')

@section('content')
<main class="main">

    {{-- Usunięto blok @php – dane $all_photos pochodzą z Kontrolera --}}

    <div class="labels">
        <ul>
            @forelse ($all_photos as $photo)
                <li>
                    <div class="gallery-item-wrapper">
                        <span class="label-card-title">{{ $photo->description }}</span>
                        <div class="gallery-item" style="cursor: pointer;" onclick="openLightbox(this)">
                            <img src="{{ asset(ltrim($photo->path ?? '', '/')) }}" alt="{{ $photo->description }}" class="img-fluid">
                            <div class="gallery-overlay">
                                <i class="bi bi-plus"></i>
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <li class="w-100 text-center py-4">Brak zdjęć do wyświetlenia.</li>
            @endforelse
        </ul>
    </div>

    <div id="lightbox" class="lightbox" onclick="closeLightbox(event)">
      <div class="lightbox-content">
        <img id="lightbox-image" src="" alt="Gallery Full Size">
        <button class="lightbox-close" onclick="closeLightbox()">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    </div>

    <div class="d-flex justify-content-center my-5">
      <a href="javascript:history.back()" class="btn btn-outline-secondary px-4 py-2">
        &leftarrow; Powrót
      </a>
    </div>
    
</main>
@endsection