@extends('layouts.public')

@section('title', 'Kontakt')

@section('body_class', 'contact-page')

@section('content')
<main class="main">
    <section id="hero" class="hero section">

     <div class="hero-wrapper">
      <div style="display: flex; gap: 20px;">
        <div style="width: 70%" class="col-lg-6 hero-content">
             <h1>Zespół Szkół w Czernikowie</h1>
             <p>ul. Gimnazjalna 1, 87-640 Czernikowo</p>
              <div class="contact-block">
                <span class="block-label">Dane rejestrowe</span>
                <p class="block-text mono-text">
                    <span>NIP: <strong>8792588182</strong></span>
                    <span>REGON: <strong>871714140</strong></span>
                </p>
                </div>
              <p class="contact-simple">
              <strong>Telefon sekretariat Sylwia Łysiak:</strong> 
              <a href="tel:+48690234679" class="contact-link">690 234 679</a>
            </p>
             <p class="contact-simple">
              <strong>Email:</strong> 
              <a href="mailto:zs@czernikowo.pl" class="contact-link">zs@czernikowo.pl</a>
            </p>
           </div>
      <img src="{{ asset('college/assets/img/logo_BT_firmowy-papier.png') }}" alt="Logo" class="img-fluid hero-image" style="height:50%;width:50%">
</div>
<div style="display: flex">

     <div class="contact-block">
  <span class="block-label">Dyrektor</span>
  <h4 class="block-title">Dariusz Chrobak</h4>
  <p class="block-text">
    mail: <a href="mailto:d.chrobak@czernikowo.pl" class="contact-link">d.chrobak@czernikowo.pl</a><br>
    tel: <a href="tel:+48519155583" class="contact-link">519 155 583</a>
  </p>
</div>
<div class="contact-block">
  <span class="block-label">Wicedyrektor (Liceum, Technikum, Branżowa Szkoła)</span>
  <h4 class="block-title">Andrejus Sivickis</h4>
  <p class="block-text">
    mail: <a href="mailto:a.sivickis@czernikowo.pl" class="contact-link">a.sivickis@czernikowo.pl</a><br>
    tel: <a href="tel:+48690591321" class="contact-link">690 591 321</a>
  </p>
</div>
<div class="contact-block">
  <span class="block-label">Wicedyrektor (Szkoła Podstawowa)</span>
  <h4 class="block-title">Dariusz Janiszewski</h4>
  <p class="block-text">
    mail: <a href="mailto:d.janiszewski@czernikowo.pl" class="contact-link">d.janiszewski@czernikowo.pl</a><br>
  </p>
</div>
<div class="contact-block">
  <span class="block-label">Wicedyrektor (Szkoła Podstawowa)</span>
  <h4 class="block-title">Tomasz Różewicki</h4>
  <p class="block-text">
    mail: <a href="mailto:t.rozewicki@czernikowo.pl" class="contact-link">t.rozewicki@czernikowo.pl</a><br>
  </p>
</div>
</div>
<h4>Portale: </h4>
<div class="contact-block">
  <a href="https://iarkusz.progman.pl/czernikowo/WebForms/Logowanie/WebLogowanie.aspx"><span class="contact-link">iarkusz</span></a>
  <br>
  <a href="https://uonetplus.vulcan.net.pl/gminaczernikowo"><span class="contact-link">Dziennik VULCAN</span></a>
  <br>
  <a href="https://konta.ksdo.gov.pl/adfs/oauth2/authorize/?response_type=id_token%20token&client_id=a1deb297-c86c-4743-a69e-8c1402274a61&state=UnZUZlR5cmVkU1EyYmtrblBWZUgxMUtuM3BVbzQ3eVBFY1VrT0tlSHphaS1X%3B%257B%2522redirectUrl%2522%253A%2522%252Fpodmiot%252F84056%252Fmain%252Fpodglad%2522%257D&redirect_uri=https%3A%2F%2Fsio.gov.pl%2Fsio%2Fzalogowany&scope=openid&nonce=UnZUZlR5cmVkU1EyYmtrblBWZUgxMUtuM3BVbzQ3eVBFY1VrT0tlSHphaS1X&x-client-SKU=ID_NET&x-client-ver=2.1.4.0&response_mode=fragment"><span class="contact-link">SIO</span></a>

</div>
</div>

   </section><!-- /Hero Section -->
   <iframe style="margin: 0 auto; display: block;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2404.163358971234!2d18.93237887716787!3d52.94548357217574!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471cc778c5039679%3A0x46ddc884d513f3a3!2zWmVzcMOzxYIgU3prw7PFgiB3IEN6ZXJuaWtvd2ll!5e0!3m2!1spl!2spl!4v1784576104602!5m2!1spl!2spl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
    

</main>
@endsection
