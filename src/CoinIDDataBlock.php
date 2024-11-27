<?php

namespace PeanutPay\PhpEvaDts;

class CoinIDDataBlock extends DataBlock
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
        return "coin changer: $this->modelNumber ($this->serialNumber) vers. $this->softwareVersion";
    }
}
