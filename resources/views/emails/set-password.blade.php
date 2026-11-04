
<x-mail::message>
# Witaj, {{ $name }}!

Twoje konto zostało pomyślnie utworzone. Aby móc się zalogować, musisz ustawić swoje własne hasło, klikając w poniższy przycisk:

<x-mail::button :url="$url">
Ustaw hasło
</x-mail::button>

Jeśli przycisk nie działa, skopiuj i wklej poniższy adres URL do przeglądarki:
<span class="break-all">{{ $url }}</span>

Pozdrawiamy,<br>
{{ config('app.name') }}
</x-mail::message>