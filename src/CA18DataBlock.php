<?php

namespace PeanutPay\PhpEvaDts;

/**
 * CA18 - Coin Manual Fill DataBlock
 * Handles coin manual fill information with 2 fields (CA1801-CA1802)
 */
class CA18DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "coinValue",                   // CA1801: Coin Value
        2 => "coinsManuallyFilled",         // CA1802: Coins Manually Filled
    ];

    public $coinValue;
    public $coinsManuallyFilled;
}
