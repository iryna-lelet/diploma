<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JWTMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if($e instanceof TokenInvalidException) {
                return response()->json(['error' => true, 'message' => 'Token is invalid']);
            } else if ($e instanceof TokenExpiredException) {
                return response()->json(['error' => true, 'message' => 'Token is expired']);
            } else {
                return response()->json(['error' => true, 'message' => 'Token is not found']);
            }
        }
        return $next($request);
    }
}
