<?php

namespace PeanutPay\PhpEvaDts;

/**
 * CA24 - Coin Inventory Value DataBlock
 * Handles coin inventory value information with 2 fields (CA2401-CA2402)
 */
class CA24DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "totalInventoryValue",         // CA2401: Total Inventory Value
        2 => "lastUpdateTime",              // CA2402: Last Update Time
    ];

    public $totalInventoryValue;
    public $lastUpdateTime;
}
