@extends('layouts.public')

@section('title', 'Galeria')

@section('body_class', 'gallery-page')

@section('content')
<main class="main">
    @php
        use Illuminate\Support\Facades\DB;
        use Carbon\Carbon;

        $dateFrom = request('from');
        $dateTo = request('to');

        $query = DB::table('newest_labels');

        if ($dateFrom) {
            $query->where('latest_updated_at', '>=', Carbon::parse($dateFrom)->startOfDay());
        }

        if ($dateTo) {
            $query->where('latest_updated_at', '<=', Carbon::parse($dateTo)->endOfDay());
        }

        $labels = $query->get();
    @endphp

    <div class="gallery-filters mb-4">
        <form action="{{ request()->url() }}" method="GET" class="gallery-filter-form">
            <div class="filter-group">
                <label for="from">Data od:</label>
                <input type="date" id="from" name="from" value="{{ request('from') }}" class="form-control">
            </div>

            <div class="filter-group">
                <label for="to">Data do:</label>
                <input type="date" id="to" name="to" value="{{ request('to') }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Filtruj</button>
            
            @if(request('from') || request('to'))
                <a href="{{ request()->url() }}" class="btn btn-secondary">Restartuj filtry</a>
            @endif
        </form>
    </div>

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
     <div class="d-flex justify-content-center my-5">
  <a href="javascript:history.back()" class="btn btn-outline-secondary px-4 py-2">
    &leftarrow; Powrót
  </a>
</div>
</main>
@endsection