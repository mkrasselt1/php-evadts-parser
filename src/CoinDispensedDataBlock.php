<?php

namespace PeanutPay\PhpEvaDts;

class CoinDispensedDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "coinValue",
        2 => "amountOutLastReset",
        3 => "manualAmountLastReset",
        4 => "amountInInit",
        5 => "manualAmountInit",
        6 => "coinAge",
        7 => "coinOrigin",
    ];

    public $coinValue = 0;
    public $amountOutLastReset = "";
    public $manualAmountLastReset = "";
    public $amountInInit = "";
    public $manualAmountInit = "";
    public $coinAge = "";
    public $coinOrigin = "";


    public function __toString()
    {
        return (($this->coinAge || $this->coinOrigin) ? ("coin age: $this->coinAge / $this->coinOrigin") : "") .
            "coin dispensed:\t " . ($this->coinValue / 100) . "\t $this->amountOutLastReset > \t $this->manualAmountLastReset\t $this->amountInInit>\t $this->manualAmountInit";
    }
}
