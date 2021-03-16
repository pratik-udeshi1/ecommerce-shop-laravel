<?php

namespace App\Http\Middleware;

use Closure;

class JwtAuthorizer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = str_replace('Bearer ', "", $request->header('Authorization'));

        try {
            auth()->setToken($token)->getPayload();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException |
            \Tymon\JWTAuth\Exceptions\TokenInvalidException |
            \Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }

        return $next($request);
    }
}
