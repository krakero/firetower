<?php

namespace Krakero\FireTower\Checks;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ApplicationInfoCheck extends Check
{
    public string $name = 'Application Info';

    public string $description = 'Gathers misc information from the application';

    public function handle(): string
    {
        $app = app();

        $this->pass()
            ->data([
                'hostname' => gethostname(),
                'is_debug_mode_on' => $app->hasDebugModeEnabled(),
                'environment' => $app->environment(),
                'laravel_version' => $app->version(),
                'is_maintenance_mode_on' => $app->isDownForMaintenance(),
                'php_version' => phpversion(),
                'url' => config('app.url'),
                'composer_packages' => $this->getComposerPackageDetail(),
            ]);

        return 'PASS';
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
