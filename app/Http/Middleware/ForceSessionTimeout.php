<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ForceSessionTimeout
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $loggedInAt = session('logged_in_at');
            $maxLifetimeInSeconds = 3600;

            if (!$loggedInAt || (now()->timestamp - $loggedInAt) > $maxLifetimeInSeconds) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('home')
                    ->with('error', 'Sesja wygasła. Minęła 1 godzina od momentu zalogowania.');
            }
        }

        return $next($request);
    }
}