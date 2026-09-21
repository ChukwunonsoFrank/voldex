<?php

namespace App\Console\Commands;

use App\Jobs\ResetDailyTasks as ResetDailyTasksJob;
use Illuminate\Console\Command;

class ResetDailyTasks extends Command
{
    protected $signature = 'app:reset-daily-tasks
                            {--scheduled : Identify an invocation from the scheduler}';

    protected $description = 'Reset task limits for users whose local date has advanced';

    public function handle(ResetDailyTasksJob $resetDailyTasks): int
    {
        $trigger = $this->option('scheduled') ? 'scheduled' : 'manual';
        $count = $resetDailyTasks->handle($trigger);

        $this->info("Reset daily task limits for {$count} users.");

        return self::SUCCESS;
    }
}
