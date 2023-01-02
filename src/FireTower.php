<?php

namespace Krakero\FireTower;

class FireTower
{
    public static function setCustomData($callback)
    {
        config(['firetower.custom' => $callback()]);
    }
}
