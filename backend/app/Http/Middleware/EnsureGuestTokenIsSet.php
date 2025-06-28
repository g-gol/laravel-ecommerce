<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class EnsureGuestTokenIsSet
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() && !$request->cookie('guest_token')) {
            $guest_token = (string)Str::uuid();
            Cookie::queue('guest_token', $guest_token, 60 * 24 * 30);
        }

        return $next($request);
    }
}
