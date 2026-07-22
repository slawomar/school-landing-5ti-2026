@extends('layouts.public')

@section('title', 'Rekrutacja')

@section('body_class', 'recruitment-page')

@section('content')
<main class="main py-5 bg-light">
    <div class="container">
        
        <header class="text-center mb-5">
            <h1 class="display-5 fw-bold text-primary mb-3">Rekrutacja do Zespołu Szkół w Czernikowie</h1>
            <p class="lead text-muted">Rok szkolny 2026/2027</p>
            
            <div class="my-4">
                <img src="{{ asset('college/assets/img/education/BANER BT_2026_FB.png') }}" 
                     alt="Rekrutacja" 
                     class="img-fluid rounded-4 shadow-sm hero-image" 
                     style="max-height: 400px; width: auto; object-fit: cover;">
            </div>

            <div class="d-flex justify-content-center gap-3 flex-wrap my-4">
                <a href="{{ asset('college/assets/uploads/REGULAMIN REKRUTACJI NA ROK SZKOLNY 2025 2026.pdf') }}" 
                   class="btn btn-primary btn-lg shadow-sm" 
                   target="_blank">
                   <i class="bi bi-file-earmark-pdf me-2"></i>Regulamin Rekrutacji
                </a>
            </div>
        </header>

        <div class="row g-4 mb-5">
            
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h2 class="h4 card-title text-primary fw-bold mb-4">
                            <i class="bi bi-mortarboard-fill me-2"></i>Kierunki kształcenia
                        </h2>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-transparent ps-0 border-0 py-2">
                                <strong class="text-dark">Technik informatyk / technik programista</strong>
                            </li>
                            <li class="list-group-item bg-transparent ps-0 border-0 py-2">
                                <strong class="text-dark">Technik logistyk z przygotowaniem wojskowym</strong>
                            </li>
                            <li class="list-group-item bg-transparent ps-0 border-0 py-2">
                                <strong class="text-dark">Liceum Ogólnokształcące — profil social media</strong>
                            </li>
                            <li class="list-group-item bg-transparent ps-0 border-0 py-2">
                                <strong class="text-dark">Branżowa Szkoła I Stopnia</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 border-start border-4 border-danger">
                    <div class="card-body p-4">
                        <h2 class="h4 card-title text-danger fw-bold mb-3">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>Ważne informacje
                        </h2>
                        <div class="alert alert-warning border-0 rounded-3 mb-3">
                            <strong>Do 12.07.2026 r.</strong> prosimy o dostarczenie brakujących dokumentów:
                            <small class="d-block text-muted mt-1">Oryginał świadectwa, zaświadczenie OKE, zaświadczenie od lekarza medycyny pracy, zdjęcia, opinia/orzeczenie.</small>
                        </div>
                        <div class="p-3 bg-light rounded-3 text-center border">
                            <span class="text-uppercase small text-muted d-block">Ogłoszenie listy przyjętych</span>
                            <strong class="h5 text-danger mb-0">20 lipca 2026 r. o godz. 12:00</strong>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <section class="card border-0 shadow-sm rounded-4 p-4 mb-5">
            <h2 class="h4 fw-bold text-dark mb-4">
                <i class="bi bi-download me-2 text-primary"></i>Dokumenty i formularze do pobrania
            </h2>
            <div class="row g-3">
                <div class="col-md-6 col-lg-4">
                    <a href="{{ asset('college/assets/uploads/wniosek do szkoły LBT 2026.pdf') }}" class="btn btn-light w-100 text-start border p-3 d-flex align-items-center rounded-3">
                        <i class="bi bi-file-pdf fs-3 text-danger me-3"></i>
                        <div>
                            <div class="fw-bold">Formularz rekrutacyjny</div>
                            <small class="text-muted">Wersja PDF</small>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="{{ asset('college/assets/uploads/wniosek do szkoły LBT 2026.docx') }}" class="btn btn-light w-100 text-start border p-3 d-flex align-items-center rounded-3">
                        <i class="bi bi-file-word fs-3 text-primary me-3"></i>
                        <div>
                            <div class="fw-bold">Formularz rekrutacyjny</div>
                            <small class="text-muted">Wersja DOCX</small>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="{{ asset('college/assets/uploads/zaswiadczenie o przyjecie na praktyki 2026.pdf') }}" class="btn btn-light w-100 text-start border p-3 d-flex align-items-center rounded-3">
                        <i class="bi bi-file-earmark-check fs-3 text-success me-3"></i>
                        <div>
                            <div class="fw-bold">Zaświadczenie od pracodawcy</div>
                            <small class="text-muted">Dotyczy Szkoły Branżowej</small>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="alert alert-info border-0 mt-4 mb-0 d-flex align-items-center rounded-3">
                <i class="bi bi-info-circle-fill me-3 fs-4"></i>
                <div>
                    <strong>Uwaga dla uczniów Technikum i Szkoły Branżowej:</strong> Skierowania na badania lekarskie są do pobrania w sekretariacie szkoły.
                </div>
            </div>
        </section>

        <section class="card border-0 shadow-sm rounded-4 p-4 mb-5">
            <h2 class="h4 fw-bold text-dark mb-4 text-center">Terminy postępowania rekrutacyjnego na rok szkolny 2026/2027</h2>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col" style="width: 50px;">#</th>
                            <th scope="col">Etap rekrutacji</th>
                            <th scope="col" style="width: 250px;">Termin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold">1</td>
                            <td>Złożenie wniosku o przyjęcie do klasy pierwszej.</td>
                            <td><span class="badge bg-light text-dark border">11.05.2026 - 12.06.2026</span> <br><small class="text-muted">do godz. 15:00</small></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">2</td>
                            <td>Złożenie świadectwa ukończenia szkoły podstawowej oraz zaświadczenia o wynikach egzaminu.</td>
                            <td><span class="badge bg-light text-dark border">23.06.2026 - 07.07.2026</span> <br><small class="text-muted">do godz. 15:00</small></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">3</td>
                            <td>Weryfikacja wniosków o przyjęcie do klasy pierwszej.</td>
                            <td><span class="badge bg-light text-dark border">do 13.07.2026</span></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">4</td>
                            <td>Podanie do publicznej wiadomości listy kandydatów zakwalifikowanych i niezakwalifikowanych.</td>
                            <td><strong class="text-primary">14.07.2026</strong> <br><small class="text-muted">do godz. 12:00</small></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">5</td>
                            <td>Wydanie skierowań na badania lekarskie (Technikum i Branżowa Szkoła I st.).</td>
                            <td><span class="badge bg-light text-dark border">11.05.2026 - 15.07.2026</span></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">6</td>
                            <td><strong>Przedłożenie oryginału świadectwa ukończenia szkoły podstawowej i zaświadczenia OKE.</strong></td>
                            <td><strong class="text-primary">do 17.07.2026</strong> <br><small class="text-muted">do godz. 15:00</small></td>
                        </tr>
                        <tr class="table-success">
                            <td class="fw-bold">7</td>
                            <td><strong>Podanie do publicznej wiadomości listy przyjętych do klas pierwszych.</strong></td>
                            <td><strong class="text-success fs-6">20.07.2026</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row g-3 mt-3 text-center">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3">
                        <i class="bi bi-envelope-at text-primary me-2"></i>
                        Wnioski elektroniczne: <a href="mailto:zs@czernikowo.pl" class="fw-bold text-decoration-none">zs@czernikowo.pl</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3">
                        <i class="bi bi-telephone text-primary me-2"></i>
                        Telefon kontaktowy: <a href="tel:690591321" class="fw-bold text-decoration-none">690 591 321</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="card border-0 shadow-sm rounded-4 p-4 mb-5">
            <h2 class="h4 fw-bold text-dark mb-3">Niezbędne dokumenty załączane do wniosku:</h2>
            <ol class="list-group list-group-numbered list-group-flush">
                <li class="list-group-item bg-transparent border-0 py-2">Świadectwo ukończenia Szkoły Podstawowej</li>
                <li class="list-group-item bg-transparent border-0 py-2">Zaświadczenie OKE</li>
                <li class="list-group-item bg-transparent border-0 py-2">Zaświadczenie od pracodawcy o przyjęciu na praktyki <em>(dotyczy Szkoły Branżowej)</em></li>
                <li class="list-group-item bg-transparent border-0 py-2">Dokumenty potwierdzające sukcesy sportowe, artystyczne itp.</li>
                <li class="list-group-item bg-transparent border-0 py-2">Jedna podpisana fotografia</li>
                <li class="list-group-item bg-transparent border-0 py-2">Zaświadczenie lekarskie o braku przeciwwskazań zdrowotnych <em>(dostarczane po zakwalifikowaniu — Technikum i Szkoła Branżowa)</em></li>
                <li class="list-group-item bg-transparent border-0 py-2">Karta zdrowia</li>
                <li class="list-group-item bg-transparent border-0 py-2">Orzeczenie o potrzebie kształcenia specjalnego lub orzeczenie o niepełnosprawności <em>(jeśli dotyczy)</em></li>
            </ol>
        </section>

        <div class="text-center mt-5">
            <img src="{{ asset('college/assets/img/logo_BT_firmowy-papier.png') }}" alt="Logo ZS Czernikowo" height="80" class="img-fluid opacity-75">
        </div>

    </div>
</main>
@endsection