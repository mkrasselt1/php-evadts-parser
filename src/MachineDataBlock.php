<?php

namespace PeanutPay\PhpEvaDts;

class MachineDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "blockIdentifier",
        2 => "data",
        3 => "optionalData1",
        4 => "optionalData2",
    ];

    public $blockIdentifier = "";
    public $data = "";
    public $optionalData1 = "";
    public $optionalData2 = "";

    public function __toString()
    {
        return "machine data ($this->blockIdentifier): $this->data $this->optionalData1 $this->optionalData2";
    }
}
