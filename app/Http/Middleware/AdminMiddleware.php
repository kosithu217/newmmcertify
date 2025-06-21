<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware // AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->hasRole("admin")) {
            // Redirect or abort if the user doesn't have the required role
            return redirect('/')->with('error', 'You do not have access to this section.');
        }

        return $next($request);
    }
    
}
