<?php

declare(strict_types=1);

use Carbon\Carbon;

if (! function_exists('toBali')) {
    /**
     * Convert a Carbon instance or date to Bali (Asia/Makassar) timezone.
     */
    function toBali(Carbon|string|null $date): ?Carbon
    {
        if ($date === null) {
            return null;
        }

        if (is_string($date)) {
            $date = Carbon::parse($date);
        }

        return $date->setTimezone('Asia/Makassar');
    }
}
