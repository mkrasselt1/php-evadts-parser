<?php

namespace PeanutPay\PhpEvaDts;

/**
 * TC10 - Time/Control Block 10 DataBlock
 * Handles time/control block 10 information with 2 fields (TC1001-TC1002)
 */
class TC10DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "controlTimestamp",            // TC1001: Control Timestamp
        2 => "controlSequence",             // TC1002: Control Sequence
    ];

    public $controlTimestamp;
    public $controlSequence;
}
