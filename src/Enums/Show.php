<?php

namespace SmartDato\DhlConnectPlusClient\Enums;

enum Show: string
{
    case Events = 'EVENTS';

    case Status = 'STATUS';

    case Both = 'BOTH';
}
