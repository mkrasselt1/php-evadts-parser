<?php

namespace PeanutPay\PhpEvaDts;

class ProductFreeVendsDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0  => "",
        1  => "numberFreeInit",
        2  => "valueFreeInit",
        3  => "numberFreeReset",
        4  => "valueFreeReset",
        3  => "numberWoCupsInit",
        4  => "numberWoCupsReset",
    ];

    public $numberFreeInit = 0;
    public $valueFreeInit = 0;
    public $numberFreeReset = 0;
    public $valueFreeReset = 0;
    public $numberWoCupsInit = 0;
    public $numberWoCupsReset = 0;

    public function toString(bool $header = false)
    {
        return (!$header ? "#test init\t reset\t\tw\ cups init\t reset\n\r" .
            "value\t number\t value\t number\n\r" : "") .
            ($this->valueFreeInit / 100) . "\t $this->numberFreeInit\t " . ($this->valueFreeReset / 100) . "\t $this->numberFreeReset\t $this->numberWoCupsInit\t $this->numberWoCupsReset\t";
    }

    public function __toString()
    {
        return $this->toString(true);
    }
}
