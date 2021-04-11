<?php

namespace JasonGuru\WebhookSigner;

use Spatie\WebhookServer\WebhookCall;
use JasonGuru\WebhookSigner\WebhookSignerService;

class WebhookService 
{
    public function isDesiredEndpoint($endpoint, $string)
    {
        return str_contains($endpoint, $string);
    }

    public function call($endpoint, $payload)
    {
        $call = WebhookCall::create()
            ->url($endpoint)
            ->payload($payload)
            ->signUsing(WebhookSignerService::class)
            ->useSecret(config('signed-webhooks.secret'));

        if(in_array(app()->environment(), config('signed-webhooks.test_envs'))) {
            $call->maximumTries(1)->doNotVerifySsl()->dispatch();
        } else {
            $call->dispatch();
        }

        return [
            'status' => true
        ];
    }
}