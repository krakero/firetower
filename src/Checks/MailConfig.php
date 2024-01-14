<?php

namespace Krakero\FireTower\Checks;

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
