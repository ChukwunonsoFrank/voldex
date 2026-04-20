<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Response;

class User
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() && !Auth::user()->is_admin) {
            $user = Auth::user();

            // Track this session
            Redis::connection()->sadd(
                "user:{$user->id}:sessions",
                session()->getId(),
            );

            return $next($request);
        }

        abort(403, "Unauthorized");
    }
}
