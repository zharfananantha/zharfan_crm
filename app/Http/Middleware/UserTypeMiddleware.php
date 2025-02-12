<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Cek apakah user memiliki type_id < 2
        if ($user && $user->user_type_id < 2) {
            return redirect()->route('leads.leads')->with('error', 'Anda tidak memiliki akses ke Projects.');
        }

        return $next($request);
    }
}
