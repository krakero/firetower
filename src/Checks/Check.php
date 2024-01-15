<?php

namespace Krakero\FireTower\Checks;

class Check
{
    public $name = null;

    public $notify_on_failure = true;

    public function getValue(): mixed
    {
        return null;
    }

    public function getName()
    {
        if ($this->name) {
            return $this->name;
        }

        return get_class($this);
    }

    public function isOk($value): bool
    {
        return false;
    }

    public function run(): bool
    {
        $value = $this->getValue();

        return $this->isOk($value);
    }
}
