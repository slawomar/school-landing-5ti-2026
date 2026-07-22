@extends('layouts.public')

@section('title', 'Artykuły')

@section('body_class', 'articles-page')

@section('content')
<main class="main">

  @php
    use Carbon\Carbon;
    use Illuminate\Support\Facades\DB;

    $articles = DB::table('articles')
        ->orderByDesc('updated_at')
        ->get(); 
  @endphp

  <div class="page-title py-4 bg-light mb-5">
    <div class="container d-lg-flex justify-content-between align-items-center">
      <h1 class="mb-2 mb-lg-0 fs-3 fw-bold">Artykuły i Aktualności</h1>
      <nav class="breadcrumbs">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Strona Główna</a></li>
          <li class="breadcrumb-item active">Artykuły</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="container mb-5">
    
    @if($articles->isEmpty())
      <div class="alert alert-info text-center py-4">
        Brak artykułów do wyświetlenia.
      </div>
    @else
      <div class="row g-4">
        @foreach ($articles as $article)
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            
            <article class="card h-100 border-0 shadow-sm overflow-hidden post-item">
              <div class="row g-0 h-100">
                
                @if($article->thumbnail)
                  <div class="col-md-5 post-img">
                    <a href="{{ route('articles.show', $article->slug) }}" class="d-block h-100">
                      <img src="{{ asset($article->thumbnail) }}" 
                           alt="{{ $article->title }}" 
                           class="img-fluid h-100 w-100" 
                           style="object-fit: contain;">
                    </a>
                  </div>
                @endif

                <div class="col-md-{{ $article->thumbnail ? '7' : '12' }} p-4 d-flex flex-column justify-content-between">
                  <div>
                    <div class="mb-2">
                      <span class="badge bg-primary-subtle text-primary fw-semibold px-2 py-1 text-uppercase fs-7">
                        {{ $article->category }}
                      </span>
                    </div>

                    <h3 class="h5 card-title fw-bold mb-2">
                      <a href="{{ route('articles.show', $article->slug) }}" class="text-decoration-none text-dark hover-primary">
                        {{ $article->title }}
                      </a>
                    </h3>

                    <p class="card-text text-muted small mb-3">
                      {{ Str::limit($article->description, 110) }}
                    </p>
                  </div>

                  <div class="border-top pt-2 mt-2">
                    <small class="text-secondary d-flex align-items-center gap-1">
                      <i class="bi bi-calendar3"></i>
                      {{ Carbon::parse($article->updated_at)->locale('pl')->translatedFormat('d M Y') }}
                    </small>
                  </div>

                </div>

              </div>
            </article>

          </div>
        @endforeach
      </div>
    @endif

  </div>
  <div class="d-flex justify-content-center my-5">
  <a href="javascript:history.back()" class="btn btn-outline-secondary px-4 py-2">
    &leftarrow; Powrót
  </a>
</div>

</main>
@endsection