<?php

namespace PeanutPay\PhpEvaDts;

class ProductTestVendsDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0  => "",
        1  => "numberTestsInit",
        2  => "valueTestsInit",
        3  => "numberTestsReset",
        4  => "valueTestsReset",
    ];

    public $numberTestsInit = 0;
    public $valueTestsInit = 0;
    public $numberTestsReset = 0;
    public $valueTestsReset = 0;
    
    public function toString(bool $header = false)
    {
        return (!$header ? "#test init\t reset\t\t\n\r" .
            "value\t number\t value\t number\n\r" : "") .
            ($this->valueTestsInit / 100) . "\t $this->numberTestsInit\t " . ($this->valueTestsReset / 100) . "\t $this->numberTestsReset\t" ;
    }

    public function __toString()
    {
        return $this->toString(true);
    }
}
