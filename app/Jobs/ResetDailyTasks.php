<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ResetDailyTasks implements ShouldQueue
{
  use Queueable;

  /**
   * Execute the job.
   */
  public function handle(): void
  {
    User::query()->chunkById(100, function ($users) {
      foreach ($users as $user) {
        $userNow = now($user->timezone);

        // Check if it's midnight for this user and they haven't been reset today
        if ($userNow->hour === 0) {
          $lastReset = $user->last_reset_at?->setTimezone($user->timezone);

          // Only reset if not already reset today in user's timezone
          if (! $lastReset || ! $lastReset->isToday()) {
            $user->update([
              'tasks_completed' => 0,
              'last_reset_at' => now(),
            ]);
          }
        }
      }
    });
  }
}
