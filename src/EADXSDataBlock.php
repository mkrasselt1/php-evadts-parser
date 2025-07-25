<?php

namespace PeanutPay\PhpEvaDts;

/**
 * EADXS - Event Audit DXS Block
 * Handles event audit data exchange system information
 */
class EADXSDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "systemId",                 // EADXS field 1: System ID
        2 => "systemType",               // EADXS field 2: System Type
        3 => "version",                  // EADXS field 3: Version
        4 => "sequenceNumber",           // EADXS field 4: Sequence Number
    ];

    public $systemId;
    public $systemType;
    public $version;
    public $sequenceNumber;
}
