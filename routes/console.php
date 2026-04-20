<?php

use App\Jobs\ResetDailyTasks;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new ResetDailyTasks)->daily()->at('00:00')->withoutOverlapping();
