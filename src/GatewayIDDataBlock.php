<?php

namespace PeanutPay\PhpEvaDts;

class GatewayIDDataBlock extends DataBlock
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
        return "gateway: $this->modelNumber ($this->serialNumber) vers. $this->softwareVersion";
    }
}
