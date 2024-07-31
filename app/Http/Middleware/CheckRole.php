<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response(['message' => 'Token not provided'], 401);
        }

        try {
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));

            $userRole = $decoded->role;


            if ($userRole !== $role) {
                return response(['message' => 'Access denied'], 403);
            }

        } catch (\Exception $e) {
            return response(['message' => 'Token is invalid or expired'], 401);
        }

        return $next($request);
    }
}
