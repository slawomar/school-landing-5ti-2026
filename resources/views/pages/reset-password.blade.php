<form action="{{ route('password.store') }}" method="POST">
    @csrf
    
    {{-- Ukryte pola przekazujące token i email z linku --}}
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">

    <div class="mb-3">
        <label class="form-label">Hasło:</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Powtórz hasło:</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Ustaw hasło</button>
</form>