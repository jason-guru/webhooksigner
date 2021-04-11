<?php

namespace JasonGuru\WebhookSigner;

use Spatie\WebhookServer\Signer\Signer;

class WebhookSignerService implements Signer
{
    public function signatureHeaderName(): string 
    {
        return config('signed-webhooks.header');
    }

    public function calculateSignature(array $payload, string $secret): string
    {
        return hash_hmac('sha256', $payload[config('signed-webhooks.key')], $secret);
    }
}