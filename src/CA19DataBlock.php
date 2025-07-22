<?php

namespace PeanutPay\PhpEvaDts;

/**
 * CA19 - Coin Refill DataBlock
 * Handles coin refill information with 9 fields (CA1901-CA1909)
 */
class CA19DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "coinValue",                   // CA1901: Coin Value
        2 => "refillAmount",                // CA1902: Refill Amount
        3 => "refillDate",                  // CA1903: Refill Date
        4 => "refillTime",                  // CA1904: Refill Time
        5 => "refilledBy",                  // CA1905: Refilled By
        6 => "refillType",                  // CA1906: Refill Type
        7 => "targetLevel",                 // CA1907: Target Level
        8 => "actualLevel",                 // CA1908: Actual Level
        9 => "refillStatus",                // CA1909: Refill Status
    ];

    public $coinValue;
    public $refillAmount;
    public $refillDate;
    public $refillTime;
    public $refilledBy;
    public $refillType;
    public $targetLevel;
    public $actualLevel;
    public $refillStatus;
}
