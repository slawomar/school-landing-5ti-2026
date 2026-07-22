@extends('layouts.public')

@section('title', 'Pełna galeria')

@section('body_class', 'gallery-page')

@section('content')
<main class="main">

    @php
        use Carbon\Carbon;
        use Illuminate\Support\Facades\DB;
        $label = request('label');
        if ($label) {
            $all_photos = DB::table('photos')
                ->where('labels', 'like', '%' . $label . '%')
                ->orderBy('updated_at', 'desc')
                ->get();
        } else {
            $all_photos = DB::table('photos')->orderBy('updated_at', 'desc')->get();
        }
    @endphp

    <div class="labels">
        <ul>
            @foreach ($all_photos as $photo)
                <li>
                    <div class="gallery-item-wrapper">
                        <span class="label-card-title">{{ $photo->description }}</span>
                        <div class="gallery-item" style="cursor: pointer;" onclick="openLightbox(this)">
                            <img src="{{ asset($photo->path) }}" alt="{{ $photo->description }}" class="img-fluid">
                            <div class="gallery-overlay">
                                <i class="bi bi-plus"></i>
                            </div>
                        </div>
                        <span class="label-card-title">{{ Carbon::parse($photo->updated_at)->locale('pl')->translatedFormat('d M Y H:i') }}</span>
                    </div>
                </li>
            @endforeach
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
</main>
@endsection
