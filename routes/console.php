<?php

use App\Jobs\ResetDailyTasks;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new ResetDailyTasks)->everyTenMinutes()->withoutOverlapping();
