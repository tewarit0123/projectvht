<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            // ถ้าไม่ได้ login ให้ตอบกลับด้วยสถานะ 401
            return response()->json([
                'error' => 'Unauthenticated. Please login first.'
            ], 401);
        }

        return $next($request);
    }
}
