<?php

namespace PeanutPay\PhpEvaDts;

/**
 * CA21 - Coin Dispenser Status DataBlock
 * Handles coin dispenser status information with 5 fields (CA2101-CA2105)
 */
class CA21DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "dispenserNumber",             // CA2101: Dispenser Number
        2 => "dispenserStatus",             // CA2102: Dispenser Status
        3 => "lastMaintenanceDate",         // CA2103: Last Maintenance Date
        4 => "operatingHours",              // CA2104: Operating Hours
        5 => "errorCode",                   // CA2105: Error Code
    ];

    public $dispenserNumber;
    public $dispenserStatus;
    public $lastMaintenanceDate;
    public $operatingHours;
    public $errorCode;
}
