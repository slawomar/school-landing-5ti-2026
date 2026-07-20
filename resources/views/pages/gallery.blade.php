@extends('layouts.public')

@section('title', 'Galeria')

@section('body_class', 'gallery-page')

@section('content')
<main class="main">
    @php
        use Illuminate\Support\Facades\DB;
        use Carbon\Carbon;
        $labels = DB::table('newest_labels')->get();
    @endphp

    <div class="labels">
        <ul>
            @foreach ($labels as $label)
                <li>
                    <a href="/gallery2?label={{ urlencode($label->label) }}" class="label-card-link">
                        <div class="gallery-item-wrapper">
                            <span class="label-card-title">{{ $label->label }}</span>
                            <div class="gallery-item">
                                <img src="{{ asset($label->path) }}" alt="{{ $label->label }}" class="img-fluid">
                            </div>
                            <span class="label-card-title">{{ Carbon::parse($label->latest_updated_at)->locale('pl')->translatedFormat('d M Y H:i') }}</span>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</main>
@endsection
