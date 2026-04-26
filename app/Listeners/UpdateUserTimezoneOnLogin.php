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
    // Only update timezone for User model instances
    if (! ($event->user instanceof User)) {
      return;
    }

    // Try to get timezone from request, session, or use default
    $timezone = Request::input('timezone')
      ?? session('timezone')
      ?? Request::header('X-Timezone')
      ?? 'UTC';

    // Update user's timezone if it's different
    if ($event->user->timezone !== $timezone) {
      $event->user->update(['timezone' => $timezone]);
    }
  }
}
