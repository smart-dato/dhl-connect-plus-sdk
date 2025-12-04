<?php

namespace SmartDato\DhlConnectPlusClient\Enums;

enum NatureCode: string
{
    case Others = '9';

    case SaleOfGoods = '11';

    case ReturnedGoods = '21';

    case Gift = '31';

    case CommercialSample = '32';

    case Documents = '91';
}
