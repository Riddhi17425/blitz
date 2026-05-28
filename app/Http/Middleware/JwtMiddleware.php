<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            // Check sales man logged or not 
            if (!$user) {
                return response()->json([
                    'result' => false,
                    'message' => 'Please login first.'
                ], 401);
            }

            // Check if the user is a salesman or not 
            if ($user->role != 3) {
                return response()->json([
                    'result' => false,
                    'message' => 'You do not have access to this section.'
                ], 403);
            }

        } catch (TokenExpiredException $e) {
            return response()->json(['result' => false, 'message' => 'Token has expired'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['result' => false, 'message' => 'Token is invalid'], 401);
        } catch (JWTException $e) {
            return response()->json(['result' => false, 'message' => 'Token is missing'], 401);
        }

        return $next($request);
    }
}
