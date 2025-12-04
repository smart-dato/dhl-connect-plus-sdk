<?php

namespace SmartDato\DhlConnectPlusClient\Enums\EndOfDay;

enum Format: string
{
    case Pdf = 'PDF';

    case Doc = 'DOC';

    case Xls = 'XLS';

    case Rtf = 'RTF';
}
