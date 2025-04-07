<?php

namespace PeanutPay\PhpEvaDts;

class ReadsOpenDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "readsInit",
        2 => "doorOpenInit",
    ];

    public $readsInit = "";
    public $doorOpenInit = "";

    public function __toString()
    {
        return
            "reports: $this->readsInit\n" .
            "door open: $this->doorOpenInit";
    }
}
