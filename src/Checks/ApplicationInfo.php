<?php

namespace Krakero\FireTower\Checks;

use Krakero\FireTower\Checks\Check;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ApplicationInfo extends Check
{
    public $name = 'Application Info';

    public function getValue(): mixed
    {
        $app = app();

        return [
            'is_debug_mode_on' => $app->hasDebugModeEnabled(),
            'environment' => $app->environment(),
            'laravel_version' => $app->version(),
            'is_maintenance_mode_on' => $app->isDownForMaintenance(),
            'php_version' => phpversion(),
            'url' => config('app.url'),
            'composer_packages' => $this->getComposerPackageDetail(),
        ];
    }

    public function isOk($value): bool
    {
        return true;
    }

    public function getComposerPackageDetail()
    {
        $process = new Process([
            config('firetower.php_path'),
            'vendor/bin/composer',
            'show',
            '-D',
            '--format=json',
            '--no-dev',
        ]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output = $process->getOutput();

        return json_decode($output)->installed;
    }
}
