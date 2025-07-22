<?php

namespace PeanutPay\PhpEvaDts;

/**
 * CA15 - Coin Hopper Status DataBlock
 * Handles coin hopper status information with 10 fields (CA1501-CA1510)
 */
class CA15DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "coinValue",                    // CA1501: Coin Value
        2 => "hopperStatus",                 // CA1502: Hopper Status
        3 => "levelStatus",                  // CA1503: Level Status
        4 => "coinsInHopper",               // CA1504: Coins In Hopper
        5 => "coinsDispensedSinceReset",    // CA1505: Coins Dispensed Since Reset
        6 => "coinsDispensedSinceInit",     // CA1506: Coins Dispensed Since Init
        7 => "coinsFilledSinceReset",       // CA1507: Coins Filled Since Reset
        8 => "coinsFilledSinceInit",        // CA1508: Coins Filled Since Init
        9 => "hopperCapacity",              // CA1509: Hopper Capacity
        10 => "nearEmptyLevel",             // CA1510: Near Empty Level
    ];

    public $coinValue;
    public $hopperStatus;
    public $levelStatus;
    public $coinsInHopper;
    public $coinsDispensedSinceReset;
    public $coinsDispensedSinceInit;
    public $coinsFilledSinceReset;
    public $coinsFilledSinceInit;
    public $hopperCapacity;
    public $nearEmptyLevel;
}
