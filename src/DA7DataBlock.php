<?php

namespace PeanutPay\PhpEvaDts;

/**
 * DA7 - Cashless Device Data Block 7
 * Handles cashless device transaction data with 8 fields
 */
class DA7DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "deviceNumber",              // DA7 field 1: Device Number
        2 => "transactionValue",         // DA7 field 2: Transaction Value
        3 => "transactionCount",         // DA7 field 3: Transaction Count
        4 => "reserved1",                // DA7 field 4: Reserved field
        5 => "valueInit",                // DA7 field 5: Value Since Init
        6 => "countInit",                // DA7 field 6: Count Since Init
        7 => "valueReset",               // DA7 field 7: Value Since Reset
        8 => "countReset",               // DA7 field 8: Count Since Reset
    ];

    public $deviceNumber;
    public $transactionValue;
    public $transactionCount;
    public $reserved1;
    public $valueInit;
    public $countInit;
    public $valueReset;
    public $countReset;
}
