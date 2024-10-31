<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class ClearanceLevelMiddleware
{
    
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::check() && Auth::user()->clearanceLevel->level >= 5){
            return $next($request);
        }

        return redirect('/');
    }
}
