<?php

namespace Krakero\FireTower\Checks;

use Krakero\FireTower\Checks\Check;

class MailConfig extends Check
{
    public $name = 'Mail Config';

    public function getValue(): mixed
    {
        return 500;
    }

    public function isOk($value): bool
    {
        return $value > 5;
    }
}
