<?php

namespace SmartDato\DhlConnectPlusClient\Enums\Label;

enum Format: string
{
    case Pdf = 'PDF';

    case Zpl = 'ZPL';

    case Epl = 'EPL';
}
