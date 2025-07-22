<?php

namespace PeanutPay\PhpEvaDts;

/**
 * TA10 - Time/Audit Block 10 DataBlock
 * Handles time/audit block 10 information with 2 fields (TA1001-TA1002)
 */
class TA10DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "auditTimestamp",              // TA1001: Audit Timestamp
        2 => "auditSequence",               // TA1002: Audit Sequence
    ];

    public $auditTimestamp;
    public $auditSequence;
}
