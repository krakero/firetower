<?php

namespace Krakero\FireTower\Checks;

class PhpVersionCheck extends Check
{
    public $name = 'PHP Version';

    public function getData(): array
    {
        return [
            'value' => phpversion()
        ];
    }

    public function isOk(): bool
    {
        return true;
    }
}
