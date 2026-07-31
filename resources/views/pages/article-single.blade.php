@extends('layouts.public')

@section('title', $article->title)

@section('body_class', 'article-page')

@section('content')
<main class="main">

  <div class="page-title py-4 bg-light mb-5">
    <div class="container d-lg-flex justify-content-between align-items-center">
      <h1 class="mb-2 mb-lg-0 fs-3">{{ $article->title }}</h1>
      <nav class="breadcrumbs">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Strona Główna</a></li>
          <li class="breadcrumb-item active">{{ $article->category }}</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-lg-10 col-xl-8">
        
        <article class="article-details">

          <div class="article-meta mb-3 d-flex align-items-center gap-3">
            <span class="badge bg-primary text-uppercase px-3 py-2 fs-6">{{ $article->category }}</span>
            <span class="text-muted small">
              <i class="bi bi-calendar3 me-1"></i>
              {{ \Carbon\Carbon::parse($article->updated_at)->locale('pl')->translatedFormat('d F Y') }}
            </span>
          </div>

          <h1 class="mb-4 display-6 fw-bold text-dark">{{ $article->title }}</h1>

          @if(isset($article->description))
            <p class="lead text-secondary mb-4 fs-5 fst-italic">
              {{ $article->description }}
            </p>
          @endif

          @if($article->thumbnail)
            <div class="article-thumbnail my-4 text-center">
              <img src="{{ asset($article->thumbnail) }}" 
                   alt="{{ $article->title }}" 
                   class="img-fluid rounded-3 shadow-sm" 
                   style="max-width: 100%; height: auto;">
            </div>
          @endif

          <hr class="my-4 opacity-25">

          <div class="article-body lh-lg fs-5 text-secondary">
            {!! $article->content !!}
          </div>

          <hr class="my-5 opacity-25">

          <div class="d-flex justify-content-between align-items-center">
            <a href="javascript:history.back()" class="btn btn-outline-secondary px-4 py-2">
              &leftarrow; Powrót
            </a>
          </div>

        </article>

      </div>
    </div>
  </div>

</main>
@endsection