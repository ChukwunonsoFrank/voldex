<?php

namespace App\Jobs;

use App\Models\User;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class ResetDailyTasks
{
  use Queueable;

  /**
   * Execute the job.
   */
  public function handle(): void
  {
    User::query()->chunkById(100, function ($users) {
      DB::transaction(function () use ($users) {
        User::whereIn('id', $users->pluck('id'))
          ->update(['tasks_completed' => 0]);
      });
    });
  }
}
