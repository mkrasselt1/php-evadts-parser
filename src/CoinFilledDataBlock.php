<?php

namespace PeanutPay\PhpEvaDts;

class CoinFilledDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "coinValue",
        2 => "amountFilledLastRest",
        3 => "amountFilledInit",
        4 => "coinAge",
        5 => "coinOrigin",
    ];

    public $coinValue = "";
    public $amountFilledLastRest = "";
    public $amountFilledInit = "";
    public $coinAge = "";
    public $coinOrigin = "";

    public function __toString()
    {
        return (($this->coinAge || $this->coinOrigin) ? ("coin age: $this->coinAge origin: $this->coinOrigin \n") : "") .
            "coin filled:\t " . ($this->coinValue / 100) . "\t $this->amountFilledLastRest \t $this->amountFilledInit";
    }
}
