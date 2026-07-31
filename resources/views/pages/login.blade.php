 @extends('layouts.public')

@section('title', 'Logowanie')

@section('body_class', 'index-page')

@section('content')
<main class="main">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Hasło:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Zaloguj się</button>
    </form>
</main>
@endsection