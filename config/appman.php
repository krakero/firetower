<?php

// config for Krakero/Appman
return [
    'server_url' => env('APPMAN_SERVER_URL', 'http://appman.test'),
    'account_key' => env('APPMAN_ACCOUNT_KEY', 'your-account-key'),
    'application_key' => env('APPMAN_APPLICATION_KEY', 'your-account-key'),
    'custom' => [
        'Vince Rocks' => 'you know it',
    ],
];
