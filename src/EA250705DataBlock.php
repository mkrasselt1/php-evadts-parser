<?php

namespace PeanutPay\PhpEvaDts;

/**
 * EA250705 - Extended Event Block
 * Handles extended event data with timestamp and payload
 */
class EA250705DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "eventCode",                // EA250705 field 1: Event Code
        2 => "reserved1",                // EA250705 field 2: Reserved
        3 => "reserved2",                // EA250705 field 3: Reserved
        4 => "eventPayload",             // EA250705 field 4: Event Payload Data
    ];

    public $eventCode;
    public $reserved1;
    public $reserved2;
    public $eventPayload;
}
