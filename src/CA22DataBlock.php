<?php

namespace PeanutPay\PhpEvaDts;

/**
 * CA22 - Coin Dispenser Inventory DataBlock
 * Handles coin dispenser inventory information with 10 fields (CA2201-CA2210)
 */
class CA22DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "coinValue",                   // CA2201: Coin Value
        2 => "dispenserNumber",             // CA2202: Dispenser Number
        3 => "coinsInDispenser",            // CA2203: Coins In Dispenser
        4 => "coinsDispensedSinceReset",    // CA2204: Coins Dispensed Since Reset
        5 => "coinsDispensedSinceInit",     // CA2205: Coins Dispensed Since Init
        6 => "coinsLoadedSinceReset",       // CA2206: Coins Loaded Since Reset
        7 => "coinsLoadedSinceInit",        // CA2207: Coins Loaded Since Init
        8 => "dispenserCapacity",           // CA2208: Dispenser Capacity
        9 => "lowLevelThreshold",           // CA2209: Low Level Threshold
        10 => "dispenserEfficiency",        // CA2210: Dispenser Efficiency
    ];

    public $coinValue;
    public $dispenserNumber;
    public $coinsInDispenser;
    public $coinsDispensedSinceReset;
    public $coinsDispensedSinceInit;
    public $coinsLoadedSinceReset;
    public $coinsLoadedSinceInit;
    public $dispenserCapacity;
    public $lowLevelThreshold;
    public $dispenserEfficiency;
}
