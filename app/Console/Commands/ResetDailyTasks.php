<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetDailyTasks extends Command
{
    protected $signature = 'app:reset-daily-tasks';

    protected $description = 'Reset daily tasks completed count for all users';

    public function handle(): int
    {
        $count = 0;

        User::query()->chunkById(100, function ($users) use (&$count) {
            DB::transaction(function () use ($users, &$count) {
                User::whereIn('id', $users->pluck('id'))
                    ->update(['tasks_completed' => 0]);

                $count += $users->count();
            });
        });

        $this->info("Reset tasks_completed for {$count} users.");

        return self::SUCCESS;
    }
}
