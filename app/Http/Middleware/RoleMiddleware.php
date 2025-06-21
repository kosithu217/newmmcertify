<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware // UserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->hasRole("user")) {
            return redirect('/')->with('error', 'Currently, you are not allowed to access the admin. Please wait for 24 hours for admin approval.');
        }else{
            if($request->user()->approved == 1 && $request->user()->email_verified_at ){
                return $next($request);
            }else{
                return redirect('/')->with('error', 'Please verify your email. Wait for 24 hours for admin approval to upload your certificates.');
            }
        }

        
    }
    
}
