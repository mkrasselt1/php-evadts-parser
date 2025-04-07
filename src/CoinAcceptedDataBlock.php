<?php

namespace PeanutPay\PhpEvaDts;

class CoinAcceptedDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "coinValue",
        2 => "amountInLastReset",
        3 => "amount2CashboxLastReset",
        4 => "amount2TubeLastReset",
        5 => "amountInInit",
        6 => "amount2CashboxInit",
        7 => "amount2TubeInit",
        8 => "coinAge",
        9 => "coinOrigin",
    ];

    public $coinValue = 0;
    public $amountInLastReset = "";
    public $amount2CashboxLastReset = "";
    public $amount2TubeLastReset = "";
    public $amountInInit = "";
    public $amount2CashboxInit = "";
    public $amount2TubeInit = "";
    public $coinAge = "";
    public $coinOrigin = "";


    public function __toString()
    {
        return (($this->coinAge || $this->coinOrigin) ? ("coin age: $this->coinAge / $this->coinOrigin") : "") .
            "coin accepted:\t " . ($this->coinValue / 100) . "\t $this->amountInLastReset = \t $this->amount2CashboxLastReset\t + $this->amount2TubeLastReset\t $this->amountInInit=\t $this->amount2CashboxInit + $this->amount2TubeInit";
    }
}
