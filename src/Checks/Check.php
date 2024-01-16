<?php

namespace Krakero\FireTower\Checks;

class Check
{
    public $name = null;

    public $notify_on_failure = true;

    public function getData(): array
    {
        return [];
    }

    public function getName()
    {
        if ($this->name) {
            return $this->name;
        }

        return get_class($this);
    }

    public function isOk($data): bool
    {
        return false;
    }
}
