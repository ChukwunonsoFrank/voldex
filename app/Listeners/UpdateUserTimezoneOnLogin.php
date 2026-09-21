<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Request;

class UpdateUserTimezoneOnLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        if (! ($event->user instanceof User)) {
            return;
        }

        $timezone = Request::input('timezone')
            ?? session('timezone')
            ?? Request::header('X-Timezone');

        if (
            ! is_string($timezone)
            || ! in_array($timezone, timezone_identifiers_list(), true)
            || $event->user->timezone === $timezone
        ) {
            return;
        }

        $event->user->update(['timezone' => $timezone]);
    }
}
