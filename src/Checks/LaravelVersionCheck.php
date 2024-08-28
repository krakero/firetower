<?php

namespace Krakero\FireTower\Checks;

class LaravelVersionCheck extends Check
{
    public $name = 'Laravel Version';

    public function getData(): array
    {
        return [
            'value' => app()->version()
        ];
    }

    public function isOk(): bool
    {
        return true;
    }
}
