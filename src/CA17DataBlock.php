<?php

namespace PeanutPay\PhpEvaDts;

/**
 * CA17 - Coin Tube Level Individual DataBlock
 * Handles individual coin tube level information with 6 fields (CA1701-CA1706)
 */
class CA17DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "coinValue",                   // CA1701: Coin Value
        2 => "tubeNumber",                  // CA1702: Tube Number
        3 => "coinsInTube",                 // CA1703: Coins In Tube
        4 => "tubeStatus",                  // CA1704: Tube Status
        5 => "tubeCapacity",                // CA1705: Tube Capacity
        6 => "nearEmptyLevel",              // CA1706: Near Empty Level
    ];

    public $coinValue;
    public $tubeNumber;
    public $coinsInTube;
    public $tubeStatus;
    public $tubeCapacity;
    public $nearEmptyLevel;
}
