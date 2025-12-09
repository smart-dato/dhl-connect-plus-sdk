<?php

namespace SmartDato\DhlConnectPlusClient\Enums;

enum Incoterms: string
{
    case Cpt = 'CPT';

    case Exw = 'EXW';

    case Ddp = 'DDP';

    case Dap = 'DAP';
}
