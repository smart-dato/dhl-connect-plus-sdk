<?php

namespace SmartDato\DhlConnectPlusClient\Facades;

use Illuminate\Support\Facades\Facade;
use SmartDato\DhlConnectPlusClient\DhlConnectPlusConnector;

/**
 * @see DhlConnectPlusConnector
 */
class DhlConnectPlus extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return DhlConnectPlusConnector::class;
    }
}
