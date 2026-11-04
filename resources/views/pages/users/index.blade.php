@extends('layouts.public')

@section('content')
<div class="container">
    <h2>Zarządzanie użytkownikami</h2>

    <a href="{{ route('users.create') }}" class="btn btn-success mb-3">+ Dodaj użytkownika</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Email</th>
                <th>Rola</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edytuj</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('home') }}" class="btn btn-outline-secondary px-4 py-2">
            &leftarrow; Powrót
        </a>
</div>
@endsection