<?php

use Krakero\FireTower\Checks\DebugModeInProductionCheck;
use Krakero\FireTower\Checks\LaravelVersionCheck;
use Krakero\FireTower\Checks\MailConfigInProductionCheck;
use Krakero\FireTower\Checks\PhpVersionCheck;

return [
    'server_url' => env('FIRETOWER_SERVER_URL', 'https://app.firetower.dev'),
    'account_key' => env('FIRETOWER_ACCOUNT_KEY', 'your-account-key'),
    'application_key' => env('FIRETOWER_APPLICATION_KEY', 'your-account-key'),
    'php_path' => env('FIRETOWER_PHP_PATH', 'php'),
];
