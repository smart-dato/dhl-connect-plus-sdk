<?php

namespace SmartDato\DhlConnectPlusClient\Enums;

enum Feature: int
{
    case ServicePointDelivery = 701;

    case NoServicePointDelivery = 702;

    case NoNeighborDelivery = 707;

    case AdHocPickup = 708;
}
