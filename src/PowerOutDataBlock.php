<?php

namespace PeanutPay\PhpEvaDts;

class PowerOutDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "outagesLastRest",
        2 => "outagesInit",
    ];

    public $outagesLastRest = "";
    public $outagesInit = "";
    
    public function __toString()
    {
        return "outages: $this->outagesLastRest (all $this->outagesInit)";
    }
}
