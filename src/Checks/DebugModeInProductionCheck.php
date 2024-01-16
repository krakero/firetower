<?php

namespace Krakero\FireTower\Checks;

class DebugModeInProductionCheck extends Check
{
    public $name = 'Debug Mode In Production';

    public function getData(): array
    {
        return [
            'value' => app()->hasDebugModeEnabled(),
        ];
    }

    public function isOk($data): bool
    {
        return app()->isProduction() ? !$data['value'] : true;
    }
}
