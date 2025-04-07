<?php

namespace PeanutPay\PhpEvaDts;

class CoinTubeDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "coinTypeNumber",
        2 => "value",
        3 => "count",
        4 => "countFilled",
        5 => "countDispensedInvent",
        6 => "tubeFull",
    ];

    public $coinTypeNumber = "";
    public $value = 0;
    public $count = "";
    public $countFilled = "";
    public $countDispensedInvent = "";
    public $tubeFull = "";

    public function __toString()
    {
        return "coin tube #" . $this->coinTypeNumber . ":\t " . ($this->value / 100) . "\t" .
            $this->count . "\t" . $this->countFilled . "\t" . $this->countDispensedInvent . "\t" .
            ($this->tubeFull == 1 ? "full" : "not full");
    }
}
