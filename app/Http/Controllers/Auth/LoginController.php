<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.login'); // Tutaj podaj ścieżkę do swojego widoku z formularzem
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('pages.home')
                ->with('success', 'Zostałeś pomyślnie zalogowany!');
        }

        return back()->withErrors([
            'email' => 'Podane dane logowania są nieprawidłowe.',
        ])->onlyInput('email');
    }

// Dodaj tę metodę do klasy LoginController
public function logout(Request $request)
{
    Auth::logout();

    // Unieważnij sesję i wygeneruj nowy token CSRF dla bezpieczeństwa
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Przekieruj na stronę główną z komunikatem
    return redirect('/')->with('success', 'Pomyślnie wylogowano.');
}
}
