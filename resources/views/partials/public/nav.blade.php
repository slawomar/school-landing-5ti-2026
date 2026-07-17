<header id="header" class="header d-flex align-items-center sticky-top">
  <div class="header-container container-fluid container-xl position-relative d-flex flex-column align-items-stretch justify-content-start">
    
    <div class="d-flex align-items-center position-relative w-100" style="min-height: 70px;">
      
      <a href="https://uonetplus.vulcan.net.pl/gminaczernikowo" class="logo d-flex align-items-center me-auto">
        {{-- <img src="{{ asset('college/assets/img/logo.webp') }}" alt=""> --}}
        <h1 class="sitename">Dziennik VULCAN</h1>
      </a>

      <a href="https://www.office.com/?auth=2" class="logo d-flex align-items-center logo-offset-1">
        {{-- <img src="{{ asset('college/assets/img/logo.webp') }}" alt=""> --}}
        <h1 class="sitename">Office 365</h1>
      </a>

      <a href="#" class="logo d-flex align-items-center logo-offset-2">
        {{-- <img src="{{ asset('college/assets/img/logo.webp') }}" alt=""> --}}
        <h1 class="sitename">Plan lekcji</h1>
      </a>

      
    </div>

    <div class="d-flex justify-content-end w-100 mt-2">
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('home') }}" class="active">Start</a></li>

          {{-- resztę na start możesz zostawić jako # albo docelowe routy --}}
          <li class="dropdown"><a href="#"><span>O szkole</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dyrekcja i administracja</a></li>
              <li><a href="#">Nauczyciele i pracownicy</a></li>
              <li><a href="#">Baza dydaktyczna</a></li>
              <li><a href="#">Dokumenty</a></li>
              <li><a href="#">Sport &amp; UKS Kopernik</a></li>
            </ul>
          </li>

          <li class="dropdown"><a href="#">Nasze szkoły <i class="bi bi-chevron-down toggle-dropdown"></i> </a>
            <ul>
              <li><a href="#">Szkoła Podstawowa</a></li>
              <li><a href="#">Liceum Ogólnokształcące</a></li>
              <li><a href="#">Technikum</a></li>
              <li><a href="#">Branżowa Szkoła</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#">Dla ucznia i rodzica <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Godziny lekcyjne i kalendarz roku szkolnego</a></li>
              <li><a href="#">Podręczniki</a></li>
              <li><a href="#">Egzaminy</a></li>
              <li><a href="#">Pomoc psychologiczno-pedagogiczna</a></li>
              <li><a href="#">Gabinet profilaktyki zdrowotnej i pomocy przedlekarskiej</a></li>
              <li><a href="#">Ubezpieczenia</a></li>
              <li><a href="#">Rada Rodziców</a></li>
              <li><a href="#">Samorząd Uczniowski</a></li>
              <li><a href="#">Dodatkowe zajęcia edukacyjne</a></li>
              <li><a href="#">Plan odwozów</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#">Projekty i programy <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">FERS</a></li>
              <li><a href="#">Rozwój kształcenia (Edycja I i II)</a></li>
              <li><a href="#">Szkoła Jutra</a></li>
              <li><a href="#">OPW (Oddziały Przygotowania Wojskowego)</a></li>
            </ul>
          </li>
          <li><a href="#">Kontakt</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>

  </div>
</header>