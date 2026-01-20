<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            if (auth()->user()->status === 'non-aktif') {
                auth()->logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')
                    ->withErrors([
                        'email' => 'Akun Anda telah di non-aktifkan'
                    ]);
            }
        }

        return $next($request);
    }

}
