<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastSeen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (Auth::check()) {
                $user = Auth::user();
                $user->last_seen = now();
                $user->save(); // Use save() instead of update() for single field
            }
        } catch (\Exception $e) {
            // Log error but don't break the request
            Log::error('Failed to update last_seen: ' . $e->getMessage());
        }

        return $next($request);
    }
}
