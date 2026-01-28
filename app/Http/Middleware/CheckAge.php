<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    
    public function handle(Request $request, Closure $next): Response
    {
        $age = (int) $request->input('age');

        if ($age >= 18) {
            return $next($request);
        }
        
        return response()->json([
            'message' => 'Ban chua du 18 tuoi',
        ], 403);
    }
}
