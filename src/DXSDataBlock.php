<?php

namespace PeanutPay\PhpEvaDts;

class DXSDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "senderId",
        2 => "functionalId",
        3 => "version",
        4 => "transmissionNbr",
        5 => "receiverId"
    ];

    public $senderId = "";
    public $functionalId = "";
    public $version = "";
    public $transmissionNbr = "";
    public $receiverId = "";

    public function __toString()
    {
        return "eva-report $this->transmissionNbr from $this->senderId for $this->receiverId($this->functionalId) vers. $this->version";
    }
}
