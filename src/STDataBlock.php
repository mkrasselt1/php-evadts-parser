<?php

namespace PeanutPay\PhpEvaDts;

class STDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "", //self::CMD_TRANSACTION_SET,
        1 => "setHeader",
        2 => "setControl"
    ];

    public $setHeader = "";
    public $setControl = "";

    public function __toString()
    {
        return "data set: $this->setHeader - control $this->setControl";
    }
}
