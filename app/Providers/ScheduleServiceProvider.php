<?php

namespace App\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class ScheduleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $schedule = $this->app->make(Schedule::class);

        $schedule->command('create:hobby')->everyMinute();
        $schedule->command('db:fresh')->everyFiveMinutes();
    }
}
