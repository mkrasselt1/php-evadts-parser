<?php

namespace PeanutPay\PhpEvaDts;

/**
 * CA23 - Coin Recycler Status DataBlock
 * Handles coin recycler status information with 4 fields (CA2301-CA2303, CA2306)
 */
class CA23DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "recyclerNumber",              // CA2301: Recycler Number
        2 => "recyclerStatus",              // CA2302: Recycler Status
        3 => "recyclingMode",               // CA2303: Recycling Mode
        4 => "",                            // CA2304: Not documented
        5 => "",                            // CA2305: Not documented
        6 => "lastServiceDate",             // CA2306: Last Service Date
    ];

    public $recyclerNumber;
    public $recyclerStatus;
    public $recyclingMode;
    public $lastServiceDate;
}
