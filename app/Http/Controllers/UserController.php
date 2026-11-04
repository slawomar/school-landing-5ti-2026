<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SetPasswordMail;

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
// Metoda obsługująca KLIKNIĘCIE W LINK Z MAILA przez nowego użytkownika
public function showSetPasswordForm(Request $request, string $token)
{
    return view('pages.reset-password', [
        'token' => $token,
        'email' => $request->email
    ]);
}

    private function getRandomString($n) {
    return bin2hex(random_bytes($n / 2));
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
        'role'     => 'required|string',
    ]);

    // Zapis bezpośrednio do bazy danych (jak w artykułach)
    $user = User::create([
        'name'       => $data['name'],
        'email'      => $data['email'],
        'password' => Hash::make($this->getRandomString(12)), // Tymczasowe hasło
        'role'       => $data['role'],
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $token = Password::broker()->createToken($user);

    // 4. Wysłanie maila przy użyciu Resenda
    Mail::to($user->email)->send(new SetPasswordMail($user, $token));

    return redirect()->route('users.index')->with('success', 'Użytkownik został utworzony, a na jego adres e-mail wysłano link do ustawienia hasła.');
}

    // Formularz edycji
    public function edit(Request $request, User $user)
    {
        if (!$request->user()->hasMinRole('admin')) {
            return redirect()->route('home')->with('error', 'Brak uprawnień.');
        }

        return view('pages.users.edit', compact('user'));
    }
    public function newPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Password::broker()->tokenExists($user, $request->token)) {
            return redirect()->back()->with('error', 'Nieprawidłowy token resetowania hasła.');
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        Password::broker()->deleteToken($user);

        return redirect()->route('login')->with('success', 'Hasło zostało pomyślnie zresetowane.');
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