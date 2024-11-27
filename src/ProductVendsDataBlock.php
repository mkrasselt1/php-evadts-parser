<?php

namespace PeanutPay\PhpEvaDts;

class ProductVendsDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0  => "",
        1  => "numberProductsInit",
        2  => "valueProductsInit",
        3  => "numberProductsReset",
        4  => "valueProductsReset",
        5  => "numberDiscountsInit",
        6  => "valueDiscountsInit",
        7  => "numberDiscountsReset",
        8  => "valueDiscountsReset",
        9  => "numberSurchargesInit",
        10 => "valueSurchargesInit",
        11 => "numberSurchargesReset",
        12 => "valueSurchargesReset",
    ];

    public $numberProductsInit = 0;
    public $valueProductsInit = 0;
    public $numberProductsReset = 0;
    public $valueProductsReset = 0;
    public $numberDiscountsInit = 0;
    public $valueDiscountsInit = 0;
    public $numberDiscountsReset = 0;
    public $valueDiscountsReset = 0;
    public $numberSurchargesInit = 0;
    public $valueSurchargesInit = 0;
    public $numberSurchargesReset = 0;
    public $valueSurchargesReset = 0;

    public function toString(bool $header = false)
    {
        return (!$header ? "#prod init\t reset\t\t#disc init\t reset\t\t#surc init\t reset\t\t\n\r" .
            "value\t number\t value\t number\t value\t number\t value\t number\t value\t number\t value\t number\n\r" : "") .
            ($this->valueProductsInit / 100) . "\t $this->numberProductsInit\t " . ($this->valueProductsReset / 100) . "\t $this->numberProductsReset\t" .
            ($this->valueDiscountsInit / 100) . "\t $this->numberDiscountsInit\t " . ($this->valueDiscountsReset / 100) . "\t $this->numberDiscountsReset\t" .
            ($this->valueSurchargesInit / 100) . "\t $this->numberSurchargesInit\t " . ($this->valueSurchargesReset / 100) . "\t $this->numberSurchargesReset\t";
    }

    public function __toString()
    {
        return $this->toString(true);
    }
}
