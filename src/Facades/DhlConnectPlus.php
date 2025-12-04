<?php

namespace SmartDato\DhlConnectPlusClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SmartDato\DhlConnectPlusClient\DhlConnectPlusConnector
 */
class DhlConnectPlus extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \SmartDato\DhlConnectPlusClient\DhlConnectPlusConnector::class;
    }
}
