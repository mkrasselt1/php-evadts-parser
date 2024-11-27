<?php

namespace PeanutPay\PhpEvaDts;

class VMCIDDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "", //self::CMD_VMC_ID,
        1 => "serialNumber",
        2 => "modelNumber",
        3 => "buildStandard",
        4 => "location",
        5 => "assetNumber",
    ];

    public $serialNumber = "";
    public $modelNumber = "";
    public $buildStandard = "";
    public $location = "";
    public $assetNumber = "";

    public function __toString()
    {
        return "machine info: $this->assetNumber $this->modelNumber($this->serialNumber) vers. $this->buildStandard at location $this->location";
    }
}
