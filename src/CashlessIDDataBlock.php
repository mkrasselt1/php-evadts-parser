<?php

namespace PeanutPay\PhpEvaDts;

class CashlessIDDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "serialNumber",        // CA1001: Serial Number
        2 => "modelNumber",         // CA1002: Model Number
        3 => "softwareVersion",     // CA1003: Software Version
        4 => "assetNumber",         // CA1004: Asset Number
    ];

    public $serialNumber = "";
    public $modelNumber = "";
    public $softwareVersion = "";
    public $assetNumber = "";

    public function __toString()
    {
        return "cashless: $this->modelNumber ($this->serialNumber) vers. $this->softwareVersion";
    }
}
