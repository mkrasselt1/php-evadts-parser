<?php

namespace PeanutPay\PhpEvaDts;

/**
 * DA10 - Cashless Device Status DataBlock
 * Handles cashless device status information with 4 fields (DA1001-DA1004)
 */
class DA10DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "deviceStatus",                // DA1001: Device Status
        2 => "communicationStatus",         // DA1002: Communication Status
        3 => "lastTransactionTime",         // DA1003: Last Transaction Time
        4 => "errorCode",                   // DA1004: Error Code
    ];

    public $deviceStatus;
    public $communicationStatus;
    public $lastTransactionTime;
    public $errorCode;
}
