 @extends('layouts.public')

@section('title', 'Strona główna')

@section('body_class', 'index-page')

@section('content')
<main class="main">



 <section id="hero" class="hero section">
  @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


     <div class="hero-wrapper">
      <div style="display: flex; gap: 20px;">
        <div style="width: 70%" class="col-lg-6 hero-content">
             <h1>Zespół Szkół w Czernikowie</h1>
             <p>Witaj na stronie Zespołu Szkół w Czernikowie, w skład którego wchodzą:</p>
              <h5>Szkoła Podstawowa im. K. K. Baczyńskiego</h5>
              <h5>Liceum Ogólnokształcące im. M. Kopernika</h5>
              <h5>Technikum im. M. Kopernika</h5>
              <h5>Branżowa Szkoła I stopnia im. M. Kopernika</h5>
             <br>
             <div class="action-buttons">
               <a href="{{ route('recruitment') }}" class="btn-primary">Rekrutacja 2026/27</a>
               <a href="#" class="btn-secondary">Kalendarium</a>
             </div>
           </div>
      <img src="{{ asset('college/assets/img/logo_BT_firmowy-papier.png') }}" alt="Logo" class="img-fluid hero-image" style="height:50%;width:50%">
</div>
     </div>

     

   </section><!-- /Hero Section -->

   @php
    use Carbon\Carbon;
    use Illuminate\Support\Facades\DB;

    $articles = DB::table('articles')
        ->orderByDesc('updated_at')
        ->limit(4)
        ->get(); 
@endphp

<section id="recent-news" class="recent-news section">

   <div class="container" data-aos="fade-up" data-aos-delay="100">

  <div class="row gy-4">

    <!-- ARTYKUŁ 1 -->
    @if(isset($articles[0]))
    <div class="col-xl-6" data-aos="fade-up" data-aos-delay="100">
      <article class="post-item d-flex">
        <div class="post-img">
          <img src="{{ asset($articles[0]->thumbnail) }}" alt="">
        </div>

        <div class="post-content flex-grow-1">
          <p class="category">{{ $articles[0]->category }}</p>
          <h2 class="post-title">
             <a href="{{ route('articles.show', $articles[0]->slug) }}">
                 {{ $articles[0]->title }}
             </a>
         </h2>

          <p class="post-description">
           {{ $articles[0]->description }}
          </p>

          <div class="post-meta">
            <span class="post-date">{{ Carbon::parse($articles[0]->updated_at)->locale('pl')->translatedFormat('d M Y H:i') }}</span>
          </div>

          {{-- ODRĘBNY BLOK AKCJI DLA UPRAWNIONYCH --}}
          @if(auth()->check() && auth()->user()->hasMinRole('editor'))
            <div class="mt-2 pt-2 border-top d-flex gap-2">
              <a href="{{ route('articles.edit', $articles[0]->slug) }}" class="btn btn-sm btn-warning">
                Edytuj
              </a>
              <form action="{{ route('articles.destroy', $articles[0]->slug) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten artykuł?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                  Usuń
                </button>
              </form>
            </div>
          @endif

        </div>
      </article>
    </div>
    @endif

    <!-- ARTYKUŁ 2 -->
    @if(isset($articles[1]))
    <div class="col-xl-6" data-aos="fade-up" data-aos-delay="100">
      <article class="post-item d-flex">
        <div class="post-img">
          <img src="{{ asset($articles[1]->thumbnail) }}" alt="">
        </div>

        <div class="post-content flex-grow-1">
          <p class="category">{{ $articles[1]->category }}</p>
          <h2 class="post-title">
             <a href="{{ route('articles.show', $articles[1]->slug) }}">
                 {{ $articles[1]->title }}
             </a>
         </h2>

          <p class="post-description">
           {{ $articles[1]->description }}
          </p>

          <div class="post-meta">
            <span class="post-date">{{ Carbon::parse($articles[1]->updated_at)->locale('pl')->translatedFormat('d M Y H:i') }}</span>
          </div>

          @if(auth()->check() && auth()->user()->hasMinRole('editor'))
            <div class="mt-2 pt-2 border-top d-flex gap-2">
              <a href="{{ route('articles.edit', $articles[1]->slug) }}" class="btn btn-sm btn-warning">
                Edytuj
              </a>
              <form action="{{ route('articles.destroy', $articles[1]->slug) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten artykuł?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                  Usuń
                </button>
              </form>
            </div>
          @endif

        </div>
      </article>
    </div>
    @endif

    <!-- ARTYKUŁ 3 -->
    @if(isset($articles[2]))
    <div class="col-xl-6" data-aos="fade-up" data-aos-delay="100">
      <article class="post-item d-flex">
        <div class="post-img">
          <img src="{{ asset($articles[2]->thumbnail) }}" alt="">
        </div>

        <div class="post-content flex-grow-1">
          <p class="category">{{ $articles[2]->category }}</p>
          <h2 class="post-title">
             <a href="{{ route('articles.show', $articles[2]->slug) }}">
                 {{ $articles[2]->title }}
             </a>
         </h2>

          <p class="post-description">
           {{ $articles[2]->description }}
          </p>

          <div class="post-meta">
            <span class="post-date">{{ Carbon::parse($articles[2]->updated_at)->locale('pl')->translatedFormat('d M Y H:i') }}</span>
          </div>

          @if(auth()->check() && auth()->user()->hasMinRole('editor'))
            <div class="mt-2 pt-2 border-top d-flex gap-2">
              <a href="{{ route('articles.edit', $articles[2]->slug) }}" class="btn btn-sm btn-warning">
                Edytuj
              </a>
              <form action="{{ route('articles.destroy', $articles[2]->slug) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten artykuł?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                  Usuń
                </button>
              </form>
            </div>
          @endif

        </div>
      </article>
    </div>
    @endif

    <!-- ARTYKUŁ 4 -->
    @if(isset($articles[3]))
    <div class="col-xl-6" data-aos="fade-up" data-aos-delay="100">
      <article class="post-item d-flex">
        <div class="post-img">
          <img src="{{ asset($articles[3]->thumbnail) }}" alt="">
        </div>

        <div class="post-content flex-grow-1">
          <p class="category">{{ $articles[3]->category }}</p>
          <h2 class="post-title">
             <a href="{{ route('articles.show', $articles[3]->slug) }}">
                 {{ $articles[3]->title }}
             </a>
         </h2>

          <p class="post-description">
           {{ $articles[3]->description }}
          </p>

          <div class="post-meta">
            <span class="post-date">{{ Carbon::parse($articles[3]->updated_at)->locale('pl')->translatedFormat('d M Y H:i') }}</span>
          </div>

          @if(auth()->check() && auth()->user()->hasMinRole('editor'))
            <div class="mt-2 pt-2 border-top d-flex gap-2">
              <a href="{{ route('articles.edit', $articles[3]->slug) }}" class="btn btn-sm btn-warning">
                Edytuj
              </a>
              <form action="{{ route('articles.destroy', $articles[3]->slug) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten artykuł?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                  Usuń
                </button>
              </form>
            </div>
          @endif

        </div>
      </article>
    </div>
    @endif

 

   <a href="{{ route('articles.index') }}" class="btn btn-primary mt-4">Zobacz wszystkie aktualności</a>

@if(auth()->check() && auth()->user()->hasMinRole('editor'))

<a href="{{ route('articles.create') }}" class="btn btn-success">+ Dodaj artykuł</a>

+ Dodaj artykuł

</a>

@endif
 </div>


</div>

   </section><!-- /Recent News Section -->
   


   <!-- About Section -->
   <section id="about" class="about section">

     <div class="container" data-aos="fade-up" data-aos-delay="100">

       <div class="row align-items-center g-5">
         <div class="col-lg-6">
           <div class="about-content" data-aos="fade-up" data-aos-delay="200">
             <h2>Kalendarium</h2>

             <div class="timeline" id="timeline" data-max-visible="4">
               <div class="timeline-item">
                 <div class="timeline-dot"></div>
                 <div class="timeline-content">
                   <h4>2 września 2024 r.</h4>
                   <p>Rozpoczęcie roku szkolnego</p>
                 </div>
               </div>
               <div class="timeline-item">
                 <div class="timeline-dot"></div>
                 <div class="timeline-content">
                   <h4>09 września 2024 r.</h4>
                   <p>Ogólnopolskie czytanie „Kordian” I.Partyka, M.Daszkowska</p>
                 </div>
               </div>

               <div class="timeline-item">
                 <div class="timeline-dot"></div>
                 <div class="timeline-content">
                   <h4>Wrzesień</h4>
                   <p>Praktyki zawodowe 4TP</p>
                 </div>
               </div>
               <div class="timeline-item">
                 <div class="timeline-dot"></div>
                 <div class="timeline-content">
                   <h4>10 września 2023 r.</h4>
                   <p>Spotkanie z rodzicami klas BT</p>
                 </div>
               </div>
               <div class="timeline-item">
                 <div class="timeline-dot"></div>
                 <div class="timeline-content">
                   <h4>17 września 2023 r.</h4>
                   <p>Rada Pedagogiczna</p>
                 </div>
               </div>
               <div class="timeline-item">
                 <div class="timeline-dot"></div>
                 <div class="timeline-content">
                   <h4>20 września 2023 r.</h4>
                   <p>Deklaracje do egzaminu zawodowego oraz poprawki oraz z kwalifikacji branżowej szkoły</p>
                 </div>
               </div>
             </div>
             <button type="button" class="timeline-toggle" aria-expanded="false">Pokaż więcej</button>
           </div>
         </div>

         
       </div>

       

     </div>

   </section><!-- /About Section -->

   <!-- Gallery Section -->
   <section id="gallery" class="gallery section">

     <!-- Section Title -->
     <div class="container section-title" data-aos="fade-up">
       <h2>Galeria</h2>
       <p>Poznaj naszą szkołę poprzez fotografie z życia szkolnego</p>
     </div><!-- End Section Title -->
    @php
    $newest_photos = DB::table('newest_photos')->get(); 
    @endphp

     <div class="container" data-aos="fade-up" data-aos-delay="100">
       <div class="row justify-content-center">
         <div class="col-lg-10">
           <div class="row g-4">
             <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
               <div class="gallery-item-wrapper">
                 <span class="label-card-title">{{ $newest_photos[0]->description }}</span>
                 <div class="gallery-item" style="cursor: pointer;" onclick="openLightbox(this)">
                    <img src="{{ asset($newest_photos[0]->path) }}" alt="{{ $newest_photos[0]->description }}" class="img-fluid">
                   <div class="gallery-overlay">
                     <i class="bi bi-plus"></i>
                   </div>
                 </div>
                  <span class="label-card-title">{{ Carbon::parse($newest_photos[0]->updated_at)->locale('pl')->translatedFormat('d M Y H:i') }}</span>
               </div>
             </div>

             <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="150">
               <div class="gallery-item-wrapper">
                  <span class="label-card-title">{{ $newest_photos[1]->description }}</span>
                 <div class="gallery-item" style="cursor: pointer;" onclick="openLightbox(this)">
                    <img src="{{ asset($newest_photos[1]->path) }}" alt="{{ $newest_photos[1]->description }}" class="img-fluid">
                   <div class="gallery-overlay">
                     <i class="bi bi-plus"></i>
                   </div>
                 </div>
                 <span class="label-card-title">{{ Carbon::parse($newest_photos[1]->updated_at)->locale('pl')->translatedFormat('d M Y H:i') }}</span>
               </div>
             </div>

             <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
               <div class="gallery-item-wrapper">
                  <span class="label-card-title">{{ $newest_photos[2]->description }}</span>
                 <div class="gallery-item" style="cursor: pointer;" onclick="openLightbox(this)">
                   <img src="{{ asset($newest_photos[2]->path) }}" alt="{{ $newest_photos[2]->description }}" class="img-fluid">
                   <div class="gallery-overlay">
                     <i class="bi bi-plus"></i>
                   </div>
                 </div>
                 <span class="label-card-title">{{ Carbon::parse($newest_photos[2]->updated_at)->locale('pl')->translatedFormat('d M Y H:i') }}</span>
               </div>
             </div>

             <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="250">
               <div class="gallery-item-wrapper">
                  <span class="label-card-title">{{ $newest_photos[3]->description }}</span>
                 <div class="gallery-item" style="cursor: pointer;" onclick="openLightbox(this)">
                   <img src="{{ asset($newest_photos[3]->path) }}" alt="{{ $newest_photos[3]->description }}" class="img-fluid">
                   <div class="gallery-overlay">
                     <i class="bi bi-plus"></i>
                   </div>
                 </div>
                 <span class="label-card-title">{{ Carbon::parse($newest_photos[3]->updated_at)->locale('pl')->translatedFormat('d M Y H:i') }}</span>
               </div>
             </div>

             <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
               <div class="gallery-item-wrapper">
                  <span class="label-card-title">{{ $newest_photos[4]->description }}</span>
                 <div class="gallery-item" style="cursor: pointer;" onclick="openLightbox(this)">
                   <img src="{{ asset($newest_photos[4]->path) }}" alt="{{ $newest_photos[4]->description }}" class="img-fluid">
                   <div class="gallery-overlay">
                     <i class="bi bi-plus"></i>
                   </div>
                 </div>
                 <span class="label-card-title">{{ Carbon::parse($newest_photos[4]->updated_at)->locale('pl')->translatedFormat('d M Y H:i') }}</span>
               </div>
             </div>
           </div>

           <div class="text-center mt-5">
             <a href="{{ route('gallery') }}" class="btn btn-primary">Pełna galeria</a>
           </div>
         </div>
       </div>
     </div>

   </section><!-- /Gallery Section -->

   <!-- Lightbox Modal -->
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