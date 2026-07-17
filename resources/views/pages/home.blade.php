 @extends('layouts.public')

@section('title', 'Strona główna')

@section('body_class', 'index-page')

@section('content')
<main class="main">



 <section id="hero" class="hero section">

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
               <a href="#" class="btn-primary">Rekrutacja 2026/27</a>
               <a href="#" class="btn-secondary">Kalendarium</a>
             </div>
           </div>
      <img src="{{ asset('college/assets/img/logo_BT_firmowy-papier.png') }}" alt="Logo" class="img-fluid hero-image" style="height:50%;width:50%">
</div>
     </div>

     

   </section><!-- /Hero Section -->

<section id="recent-news" class="recent-news section">

     <!-- Section Title -->
     <div class="container section-title" data-aos="fade-up">
       <h2>Aktualności</h2>
     </div><!-- End Section Title -->

     <div class="container" data-aos="fade-up" data-aos-delay="100">

       <div class="row gy-4">

         <div class="col-xl-6" data-aos="fade-up" data-aos-delay="100">
           <article class="post-item d-flex">
             <div class="post-img">
               <img src="{{ asset('college/assets/img/education/remont_ZS2026.jpeg') }}" alt="">
             </div>

             <div class="post-content flex-grow-1">
               <p class="category">Komunikat</p>

               <h2 class="post-title">
                 <a href="#">Uwaga! trwają prace remontowe</a>
               </h2>

               <p class="post-description">
                
               </p>

               <div class="post-meta">
                 <div class="post-author">
                   <span class="author-name">Redaktor</span>
                 </div>
                 <span class="post-date">2026/07/01</span>
               </div>
             </div>
           </article>
         </div><!-- End post item -->

         <div class="col-xl-6" data-aos="fade-up" data-aos-delay="100">
           <article class="post-item d-flex">
             <div class="post-img">
               <img src="{{ asset('college/assets/img/education/BANER BT_2026_FB.png') }}" alt="">
             </div>

             <div class="post-content flex-grow-1">
               <p class="category">Rekrutacja</p>

               <h2 class="post-title">
                 <a href="#">Rekrutacja 2026</a>
               </h2>

               <p class="post-description">
                
               </p>

               <div class="post-meta">
                 <div class="post-author">
                   <span class="author-name">Redaktor</span>
                 </div>
                 <span class="post-date">2026/03/24</span>
               </div>
             </div>
           </article>
         </div><!-- End post item -->

         <div class="col-xl-6" data-aos="fade-up" data-aos-delay="100">
           <article class="post-item d-flex">
             <div class="post-img">
               <img src="{{ asset('college/assets/img/education/kopernik_datek.jpg') }}" alt="">
             </div>

             <div class="post-content flex-grow-1">
               <p class="category">Ogłoszenie</p>

               <h2 class="post-title">
                 <a href="#">Przekaż 1,5% na sportowe wyposażenie naszej Szkoły</a>
               </h2>

               <p class="post-description">
                
               </p>

               <div class="post-meta">
                 <div class="post-author">
                   <span class="author-name">Redaktor</span>
                 </div>
                 <span class="post-date">2026/03/01</span>
               </div>
             </div>
           </article>
         </div><!-- End post item -->

         <div class="col-xl-6" data-aos="fade-up" data-aos-delay="100">
           <article class="post-item d-flex">
             <div class="post-img">
               <img src="{{ asset('college/assets/img/education/dzien-nauki-kopernik.png') }}" alt="">
             </div>

             <div class="post-content flex-grow-1">
               <p class="category">Komunikat</p>

               <h2 class="post-title">
                 <a href="#">19 lutego dzień urodzin Naszego Patrona</a>
               </h2>

               <p class="post-description">
                19 lutego – urodziny Mikołaja Kopernika i Dzień Nauki Polskiej
               </p>

               <div class="post-meta">
                 <div class="post-author">
                   <span class="author-name">Redaktor</span>
                 </div>
                 <span class="post-date">2026/02/19</span>
               </div>
             </div>
           </article>
         </div><!-- End post item -->

      <a href="#" class="btn btn-primary mt-4">Zobacz wszystkie aktualności</a>

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

     <div class="container" data-aos="fade-up" data-aos-delay="100">
       <div class="row justify-content-center">
         <div class="col-lg-10">
           <div class="row g-4">
             <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
               <div class="gallery-item-wrapper">
                 <div class="gallery-item" style="cursor: pointer;" onclick="openLightbox(this)">
                   <img src="{{ asset('college/assets/img/blog/blog-post-1.webp') }}" alt="Gallery" class="img-fluid">
                   <div class="gallery-overlay">
                     <i class="bi bi-plus"></i>
                   </div>
                 </div>
                 <p class="gallery-date">15 lipca 2026</p>
               </div>
             </div>

             <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="150">
               <div class="gallery-item-wrapper">
                 <div class="gallery-item" style="cursor: pointer;" onclick="openLightbox(this)">
                   <img src="{{ asset('college/assets/img/blog/blog-post-square-1.webp') }}" alt="Gallery" class="img-fluid">
                   <div class="gallery-overlay">
                     <i class="bi bi-plus"></i>
                   </div>
                 </div>
                 <p class="gallery-date">12 lipca 2026</p>
               </div>
             </div>

             <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
               <div class="gallery-item-wrapper">
                 <div class="gallery-item" style="cursor: pointer;" onclick="openLightbox(this)">
                   <img src="{{ asset('college/assets/img/blog/blog-post-square-2.webp') }}" alt="Gallery" class="img-fluid">
                   <div class="gallery-overlay">
                     <i class="bi bi-plus"></i>
                   </div>
                 </div>
                 <p class="gallery-date">10 lipca 2026</p>
               </div>
             </div>

             <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="250">
               <div class="gallery-item-wrapper">
                 <div class="gallery-item" style="cursor: pointer;" onclick="openLightbox(this)">
                   <img src="{{ asset('college/assets/img/blog/blog-post-square-3.webp') }}" alt="Gallery" class="img-fluid">
                   <div class="gallery-overlay">
                     <i class="bi bi-plus"></i>
                   </div>
                 </div>
                 <p class="gallery-date">8 lipca 2026</p>
               </div>
             </div>

             <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
               <div class="gallery-item-wrapper">
                 <div class="gallery-item" style="cursor: pointer;" onclick="openLightbox(this)">
                   <img src="{{ asset('college/assets/img/blog/blog-post-square-4.webp') }}" alt="Gallery" class="img-fluid">
                   <div class="gallery-overlay">
                     <i class="bi bi-plus"></i>
                   </div>
                 </div>
                 <p class="gallery-date">5 lipca 2026</p>
               </div>
             </div>
           </div>

           <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="350">
             <a href="#" class="btn btn-primary">Pełna galeria</a>
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