<?php

namespace Doitcloud\EmailServices;

use Illuminate\Support\ServiceProvider;

class EmailServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Merge package config so users get defaults without publishing
        $this->mergeConfigFrom(__DIR__ . '/../config/EmailService.php', 'emailservice');
    }

    public function boot(): void
    {
        // Allow users to publish the config to their app/config
        $this->publishes([
            __DIR__ . '/../config/EmailService.php' => config_path('EmailService.php'),
        ], 'emailservice-config');
    }
}
