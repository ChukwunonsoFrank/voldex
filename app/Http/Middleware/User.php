<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class User
{
  public function handle(Request $request, Closure $next): Response
  {
    if (Auth::user() && !Auth::user()->is_admin) {
      $user = Auth::user();

      return $next($request);
    }

    abort(403, "Unauthorized");
  }
}
