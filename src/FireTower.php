<?php

namespace Krakero\FireTower;

class FireTower
{
    public $checksCallback;

    public function checks($checksCallback)
    {
        $this->checksCallback = $checksCallback;
    }

    public function getChecks()
    {
        $callback = $this->checksCallback;

        if ($callback) {
            return $callback();
        }

        return null;
    }
}
