<?php

namespace PeanutPay\PhpEvaDts;

class VendsFreeDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "valueFreeInit",
        2 => "numberFreeInit",
        3 => "valueFreeReset",
        4 => "numberFreeReset",
    ];

    public $valueFreeInit = 0;
    public $numberFreeInit = 0;
    public $valueFreeReset = 0;
    public $numberFreeReset = 0;

    public function __toString()
    {
        return
            "free:\t " . ($this->valueFreeInit / 100) . "\t $this->numberFreeInit\t " . ($this->valueFreeReset / 100) . "\t $this->numberFreeReset";
    }
}
