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

    public function isOk(): bool
    {
        return !app()->isProduction() || !$this->data['value'];
    }

    public function getStatus($okay): string
    {
        return $okay ? 'ok' : 'Debug mode is enabled in production';
    }
}
