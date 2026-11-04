@extends('layouts.public')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edytuj użytkownika: {{ $user->name }}</h2>

        {{-- Formularz usuwania użytkownika --}}
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tego użytkownika? Ta operacja jest nieodwracalna.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Usuń użytkownika</button>
        </form>
    </div>

    {{-- Formularz edycji danych --}}
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nazwa --}}
        <div class="mb-3">
            <label class="form-label">Nazwa:</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Hasło (opcjonalne) --}}
        <div class="mb-3">
            <label class="form-label">Nowe hasło (pozostaw puste, jeśli nie zmieniasz):</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Rola --}}
        <div class="mb-3">
            <label class="form-label">Rola:</label>
            <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                @php $currentRole = old('role', $user->role); @endphp
                <option value="teacher" {{ $currentRole === 'teacher' ? 'selected' : '' }}>Teacher</option>
                <option value="editor" {{ $currentRole === 'editor' ? 'selected' : '' }}>Editor</option>
                <option value="admin" {{ $currentRole === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Anuluj</a>
        </div>
    </form>
</div>
@endsection