<?php

namespace PeanutPay\PhpEvaDts;

class BillIDDataBlock extends DataBlock
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
        return "bill acceptor: $this->modelNumber ($this->serialNumber) vers. $this->softwareVersion";
    }
}
