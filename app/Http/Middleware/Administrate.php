<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Administrate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */

    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('auth.login');
        }

        if (!auth()->user()->is_admin) {
            return redirect()->back()->withErrors('Неверный логин или адрес электронной почты');
            // abort(403, 'Доступ запрещен. Вы не администратор.');
        }

        return $next($request);
    }
}
