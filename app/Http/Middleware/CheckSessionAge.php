<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionAge
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('age_verified')) {
            return redirect()->route('product.age');
        }

        return $next($request);
    }
}