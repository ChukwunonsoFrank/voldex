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

        // Reset tasks if it's midnight for this user
        if ($userNow->hour === 0) {
          $user->update(['tasks_completed' => 0]);
        }
      }
    });
  }
}
