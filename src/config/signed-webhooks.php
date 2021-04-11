<?php

return [
    'header' => env('WEBHOOK_SIGN_HEADER'),
    'secret' => env('WEBHOOK_SHARED_SECRET'),
    'test_envs' => [
        'local', 
        'testing'
    ],
    'key' => 'event'
];