<?php

namespace Krakero\FireTower\Checks;

class DebugModeInProductionCheck extends Check
{
    public string $name = 'Debug Mode In Production';

    public string $description = 'Verifies that Debug Mode is turned off in production';

    public function handle(): string
    {
        $app = app();

        $this->data([
            'environment' => $app->environment(),
            'debug_mode_on' => $app->hasDebugModeEnabled(),
        ]);

        if ($app->isProduction() && $app->hasDebugModeEnabled()) {
            $this->fail();
            return 'Debug Mode On In Production';
        }

        $this->pass();

        return 'PASS';
    }
}
