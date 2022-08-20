<?php

namespace Krakero\Appman\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Krakero\Appman\Appman
 */
class Appman extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'appman';
    }
}
