<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:reset-daily-tasks --scheduled')
    ->everyTenMinutes()
    ->withoutOverlapping(20);
