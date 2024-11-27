<?php

namespace PeanutPay\PhpEvaDts;

class VendsTestDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "valueTestInit",
        2 => "numberTestInit",
        3 => "valueTestReset",
        4 => "numberTestReset",
    ];

    public $valueTestInit = 0;
    public $numberTestInit = 0;
    public $valueTestReset = 0;
    public $numberTestReset = 0;

    public function __toString()
    {
        return
            "test:\t " . ($this->valueTestInit / 100) . "\t $this->numberTestInit\t " . ($this->valueTestReset / 100) . "\t $this->numberTestReset";
    }
}
