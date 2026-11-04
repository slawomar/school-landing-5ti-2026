@extends('layouts.public')

@section('content')
<div class="container">
    <h2>Dodaj użytkownika</h2>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        
        {{-- Nazwa --}}
        <div class="mb-3">
            <label class="form-label">Nazwa:</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Hasło --}}
        <div class="mb-3">
            <label class="form-label">Hasło:</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Rola --}}
        <div class="mb-3">
            <label class="form-label">Rola:</label>
            <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                <option value="teacher">Teacher</option>
                <option value="editor">Editor</option>
                <option value="admin" >Admin</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Zapisz</button>
    </form>
</div>
@endsection