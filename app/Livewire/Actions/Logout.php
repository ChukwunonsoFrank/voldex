<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class Logout
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke()
    {
        $userId = Auth::id();
        $sessionId = session()->getId();

        // Remove this session from the tracking set
        Redis::connection()->srem("user:{$userId}:sessions", $sessionId);

        Auth::guard("web")->logout();

        $loggedInFromApp = session("device");

        Session::invalidate();
        Session::regenerateToken();

        if ($loggedInFromApp === "app") {
            return redirect("/applogin");
        }

        return redirect("/login");
    }
}
