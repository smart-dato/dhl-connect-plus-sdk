<?php

namespace SmartDato\DhlConnectPlusClient\Enums\Label;

enum Action: string
{
    case Print = 'PRINT';

    case Delete = 'DELETE';

    case Hold = 'HOLD';

    case Release = 'RELEASE';
}
