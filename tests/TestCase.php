<?php
namespace JasonGuru\WebhookSigner\Tests;

use JasonGuru\WebhookSigner\WebhookSignerServiceProvider;


class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            WebhookSignerServiceProvider::class,
        ];
    }
}