<?php

use Illuminate\Support\Facades\DB;

$now = now()->toDateTimeString();
// DB::statement("
//     INSERT INTO articles (title, slug, thumbnail, description, content, category, created_at, updated_at) 
//     VALUES 
//     ('19 lutego dzień urodzin Naszego Patrona', '19-lutego-urodziny-mikolaja-kopernika-i-dzien-nauki-polskiej', 'college/assets/img/education/dzien-nauki-kopernik.png', '19 lutego – urodziny Mikołaja Kopernika i Dzień Nauki Polskiej', '<p>19 lutego obchodzimy święto państwowe –&nbsp;Dzień Nauki Polskiej. Jako datę corocznych obchodów wyznaczono dzień urodzin Mikołaja Kopernika w uznaniu jego wybitnych zasług na polu astronomii.</p> <p>Dzień Nauki Polskiej jest&nbsp; wyrazem najwyższego szacunku dla dokonań polskich naukowców czasów minionych i współczesnych, stanowi inspirację do wzmocnienia zainteresowania nauką.</p>', 'Ogłoszenie', '{$now}', '{$now}')");

// DB::statement("
//     INSERT INTO articles (title, slug, thumbnail, description, content, category, created_at, updated_at) 
//     VALUES 
//     ('Uwaga! trwają prace remontowe', 'uwaga-trwaja-prace-remontowe', 'college/assets/img/education/remont_ZS2026.jpeg', 'Uwaga! trwają prace remontowe', '', 'Komunikat', '2026/07/01 11:33:00', '2026/07/01 11:33:00')");

// DB::statement("
//     INSERT INTO articles (title, slug, thumbnail, description, content, category, created_at, updated_at) 
//     VALUES 
//     ('Rekrutacja 2026', 'rekrutacja-2026', 'college/assets/img/education/BANER BT_2026_FB.png', '', '', 'Rekrutacja', '2026/03/24 11:33:00', '2026/03/24 11:33:00')");

// 

DB::statement("
    INSERT INTO articles (title, slug, thumbnail, description, content, category, created_at, updated_at) 
    VALUES 
    ('podziękowanie od OPW', 'podziekowanie-od-OPW', '', 'Serdeczne podziękowania', '<p>Składamy gorące podziękowania za okazaną pomoc finansową przy organizacji wyjazdu uczniów klasy 2 OPW z Technikum im. Mikołaja Kopernika w Czernikowie na II Światowy Zlot Młodzieży Polskiej z Kraju i z Zagranicy, który odbył się na Monte Cassino we Włoszech.</p>', 'Podziękowanie', '2025/10/18 12:36:00', '2025/10/28 12:36:00')");