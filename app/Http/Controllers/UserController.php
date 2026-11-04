<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Lista użytkowników
    public function index(Request $request)
    {
        if (!$request->user()->hasMinRole('admin')) {
            return redirect()->route('home')->with('error', 'Brak uprawnień.');
        }

        $users = User::all();
        return view('pages.users.index', compact('users'));
    }

    // Formularz dodawania
    public function create(Request $request)
    {
        if (!$request->user()->hasMinRole('admin')) {
            return redirect()->route('home')->with('error', 'Brak uprawnień.');
        }

        return view('pages.users.create');
    }

    // Zapis nowego użytkownika
    public function store(Request $request)
{
    if (!$request->user()->hasMinRole('admin')) {
        return redirect()->route('home')->with('error', 'Brak uprawnień.');
    }

    $data = $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'role'     => 'required|string',
    ]);

    // Zapis bezpośrednio do bazy danych (jak w artykułach)
    DB::table('users')->insert([
        'name'       => $data['name'],
        'email'      => $data['email'],
        'password'   => Hash::make($data['password']),
        'role'       => $data['role'],
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('users.index')->with('success', 'Użytkownik został dodany.');
}

    // Formularz edycji
    public function edit(Request $request, User $user)
    {
        if (!$request->user()->hasMinRole('admin')) {
            return redirect()->route('home')->with('error', 'Brak uprawnień.');
        }

        return view('pages.users.edit', compact('user'));
    }

    // Zapis edycji użytkownika
    public function update(Request $request, User $user)
    {
        if (!$request->user()->hasMinRole('admin')) {
            return redirect()->route('home')->with('error', 'Brak uprawnień.');
        }

        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|string',
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8']);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Dane użytkownika zostały zaktualizowane.');
    }
    public function destroy(Request $request, $id)
{
    if (!$request->user()->hasMinRole('admin')) {
        return redirect()->route('home')->with('error', 'Brak uprawnień.');
    }

    if ($request->user()->id == $id) {
        return redirect()->back()->with('error', 'Nie możesz usunąć własnego konta!');
    }

    \App\Models\User::destroy($id);

    return redirect()->route('users.index')->with('success', 'Użytkownik został usunięty.');
}
}