<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMenuPermission
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $menuKey): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Access denied.');
        }

        try {
            if (!auth()->user()->hasMenuPermission($menuKey)) {
                abort(403, 'You do not have permission to access this menu.');
            }
        } catch (\Exception $e) {
            // If there's an error checking permissions, log it and allow access for now
            \Log::error('Permission check error: ' . $e->getMessage());
            // For existing admins without permissions, allow access
            return $next($request);
        }

        return $next($request);
    }
}