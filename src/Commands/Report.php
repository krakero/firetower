<?php

namespace Krakero\FireTower\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Report extends Command
{
    public $signature = 'firetower:report';

    public $description = 'Reports data to your server';

    public function handle(): int
    {
        $url = config('firetower.server_url').'/api/report/'.config('firetower.account_key').'/'.config('firetower.application_key');
        $app = app();
        $data = [
            'is_debug_mode_on' => $app->hasDebugModeEnabled(),
            'environment' => $app->environment(),
            'laravel_version' => $app->version(),
            'is_maintenance_mode_on' => $app->isDownForMaintenance(),
            'php_version' => phpversion(),
            'url' => config('app.url'),
            'composer_packages' => $this->getComposerPackageDetail(),
            'custom_data' => config('firetower.custom'),
        ];
        $response = Http::post($url, $data);

        if ($response->successful()) {
            $this->comment('Report Complete');

            return self::SUCCESS;
        }

        $this->error('Report Failed');
        $this->error($response->body());

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
            '--no-dev',
        ]);
        $process->run();

        if (! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output = $process->getOutput();

        return json_decode($output)->installed;
    }
}
