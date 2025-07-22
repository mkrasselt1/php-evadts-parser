<?php

namespace PeanutPay\PhpEvaDts;

/**
 * CA16 - Coin Hopper Level DataBlock
 * Handles coin hopper level information with 2 fields (CA1601-CA1602)
 */
class CA16DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "hopperNumber",                // CA1601: Hopper Number
        2 => "levelStatus",                 // CA1602: Level Status
    ];

    public $hopperNumber;
    public $levelStatus;
}
