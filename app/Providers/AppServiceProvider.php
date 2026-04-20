<?php

namespace App\Providers;

use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::shouldBeStrict(! app()->isProduction());

        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(app()->isProduction());

        Blade::directive('money', function ($amount) {
            return "<?php echo number_format($amount, 2, '.', ',') . ' USDT'; ?>";
        });

        Blade::directive('maskEmail', function ($email) {
            return "<?php
        // Remove quotes from the email variable
        \$email = trim($email, \"'\");
        \$atPosition = strpos(\$email, '@');
        \$name = substr(\$email, 0, \$atPosition);
        \$domain = substr(\$email, \$atPosition);
        if (strlen(\$name) > 2) {
          // Use HTML entity for asterisk to ensure uniform size
          \$asterisk = '&#42;';
          \$maskedName = substr(\$name, 0, 1) . str_repeat(\$asterisk, strlen(\$name) - 2) . substr(\$name, -1);
        } else {
          \$maskedName = \$name;
        }
        echo \$maskedName . \$domain;
      ?>";
        });

        Gate::define('viewPulse', function (User $user) {
            return $user->isAdmin();
        });
    }
}
