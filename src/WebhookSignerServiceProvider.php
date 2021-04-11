<?php

namespace JasonGuru\WebhookSigner;

use Illuminate\Support\ServiceProvider;
use JasonGuru\WebhookSigner\WebhookService;

class WebhookSignerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('webhook', function($app) {
            return new WebhookService();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/signed-webhooks.php' => config_path('signed-webhooks.php')
        ], 'config');
    }
}