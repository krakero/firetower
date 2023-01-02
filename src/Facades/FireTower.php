<?php

namespace Krakero\FireTower\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Krakero\FireTower\FireTower
 */
class FireTower extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'firetower';
    }
}
