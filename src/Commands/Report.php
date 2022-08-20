<?php

namespace Krakero\Appman\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Krakero\Appman\Facades\Appman;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Report extends Command
{
    public $signature = 'appman:report';

    public $description = 'Reports data to your server';

    public function handle(): int
    {
        $url = config('appman.server_url') . '/api/report/' . config('appman.account_key') . '/' . config('appman.application_key');
        $app = app();
        $response = Http::post($url, [
            'is_debug_mode_on' => $app->hasDebugModeEnabled(),
            'enviroment' => $app->environment(),
            'laravel_version' => $app->version(),
            'is_maintenance_mode_on' => $app->isDownForMaintenance(),
            'php_version' => phpversion(),
            'url' => config('app.url'),
            'composer_packages' => $this->getComposerPackageDetail(),
            'custom_data' => Appman::getCustomData(),
        ]);

        if ($response->successful()) {
            $this->comment('Report Complete');
            return self::SUCCESS;
        }

        return self::FAILURE;
    }

    public function getComposerPackageDetail()
    {
        $process = new Process([
            'php',
            'vendor/bin/composer',
            'show',
            '-D',
            '--format=json',
            '--no-dev'
        ]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output = $process->getOutput();

        return json_decode($output)->installed;
    }
}
