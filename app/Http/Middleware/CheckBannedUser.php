<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Response;

class CheckBannedUser
{
  public function handle(Request $request, Closure $next): Response
  {
    if (Auth::check() && Auth::user()->is_banned) {
      $userId = Auth::id();
      $sessionId = session()->getId();

      // Check if logged in from app
      $loggedInFromApp = session("device");
      if ($loggedInFromApp === "app") {
        // Logout first
        Auth::guard("web")->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/applogin")->with(
          "error",
          "Your account has been banned.",
        );
      }

      // Remove from tracking set
      Redis::connection()->srem("user:{$userId}:sessions", $sessionId);

      // Logout the user
      Auth::guard("web")->logout();

      // Invalidate session
      $request->session()->invalidate();
      $request->session()->regenerateToken();

      // Redirect with message
      return redirect()
        ->route("login")
        ->with(
          "error",
          "Your account has been banned. Contact support at support@yfxai.com",
        );
    }

    return $next($request);
  }
}
