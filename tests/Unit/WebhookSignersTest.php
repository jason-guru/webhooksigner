<?php

namespace JasonGuru\WebhookSigner\Tests\Unit;
 
use JasonGuru\WebhookSigner\Tests\TestCase;
use JasonGuru\WebhookSigner\Facades\Webhook;
use Illuminate\Foundation\Testing\RefreshDatabase;
 
Class WebhookSignersTest extends TestCase
{
    use RefreshDatabase;

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('signed-webhooks', [
            'header' => 'signature',
            'secret' => 'test',
            'test_envs' => [
                'local', 
                'testing'
            ],
            'key' => 'event'
        ]);

        $app['config']->set('webhook-server', [
            'queue' => 'default',
            'http_verb' => 'post',
            'signer' => \Spatie\WebhookServer\Signer\DefaultSigner::class,
            'signature_header_name' => 'Signature',
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'timeout_in_seconds' => 3,
            'tries' => 3,
            'backoff_strategy' => \Spatie\WebhookServer\BackoffStrategy\ExponentialBackoffStrategy::class,
            'verify_ssl' => true,
            'tags' => [],
        ]);
    }
    
    /** @test */
    public function new()
    {
        $this->withoutExceptionHandling();
        if(Webhook::isDesiredEndpoint('https://dev.usespeak.com', 'speak')) {
            $call = Webhook::call('https://webhook.site/418010c1-6a88-44ad-be8a-3d7c5a1f6a1d', [
                'order' => ['hey'],
                'event' => 'order.created'
            ]);
            $this->assertTrue($call['status']);
        }
    }
}