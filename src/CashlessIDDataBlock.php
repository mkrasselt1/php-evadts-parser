<?php

namespace PeanutPay\PhpEvaDts;

class CashlessIDDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "serialNumber",
        2 => "modelNumber",
        3 => "softwareVersion",
    ];

    public $serialNumber = "";
    public $modelNumber = "";
    public $softwareVersion = "";

    public function __toString()
    {
        return "cashless: $this->modelNumber ($this->serialNumber) vers. $this->softwareVersion";
    }
}
