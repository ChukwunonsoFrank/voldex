<?php

namespace App\Jobs;

use App\Models\User;
use DateTimeZone;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ResetDailyTasks
{
    /**
     * Execute the job.
     */
    public function handle(string $trigger = 'scheduled'): int
    {
        $lock = Cache::lock('daily-task-reset', 900);

        if (! $lock->get()) {
            Log::warning('Daily task reset skipped because another reset is running.', [
                'trigger' => $trigger,
            ]);

            return 0;
        }

        $resetCount = 0;

        try {
            User::query()
                ->select(['id', 'timezone', 'last_reset_at', 'created_at'])
                ->chunkById(100, function ($users) use (&$resetCount, $trigger): void {
                    foreach ($users as $candidate) {
                        if (! $this->shouldReset($candidate)) {
                            continue;
                        }

                        $wasReset = DB::transaction(function () use ($candidate, $trigger): bool {
                            $user = User::query()->lockForUpdate()->find($candidate->id);

                            if (! $user || ! $this->shouldReset($user)) {
                                return false;
                            }

                            $timezone = new DateTimeZone($user->timezone);
                            $userNow = now($timezone);

                            $previousValues = [
                                'tasks_completed' => $user->tasks_completed,
                                'task_batch' => $user->task_batch,
                                'daily_commission' => $user->daily_commission,
                            ];

                            $user->update([
                                'tasks_completed' => 0,
                                'task_batch' => 0,
                                'daily_commission' => 0,
                                'last_reset_at' => now(),
                            ]);

                            Log::info('Daily task limits reset.', [
                                'user_id' => $user->id,
                                'timezone' => $user->timezone,
                                'local_date' => $userNow->toDateString(),
                                'trigger' => $trigger,
                                'previous' => $previousValues,
                            ]);

                            return true;
                        }, 3);

                        if ($wasReset) {
                            $resetCount++;
                        }
                    }
                });
        } finally {
            $lock->release();
        }

        Log::info('Daily task reset completed.', [
            'reset_count' => $resetCount,
            'trigger' => $trigger,
        ]);

        return $resetCount;
    }

    private function shouldReset(User $user): bool
    {
        try {
            $timezone = new DateTimeZone($user->timezone);
        } catch (Throwable $exception) {
            Log::warning('Daily task reset skipped for a user with an invalid timezone.', [
                'user_id' => $user->id,
                'timezone' => $user->timezone,
                'exception' => $exception->getMessage(),
            ]);

            return false;
        }

        $previousReset = $user->last_reset_at ?? $user->created_at;

        return ! $previousReset
            || $previousReset
                ->setTimezone($timezone)
                ->startOfDay()
                ->lt(now($timezone)->startOfDay());
    }
}
