<?php

namespace PeanutPay\PhpEvaDts;

class CashlessVendsDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "valuePaidInit",
        2 => "numberPaidInit",
        3 => "valuePaidReset",
        4 => "numberPaidReset",
    ];

    public $valuePaidInit = 0;
    public $numberPaidInit = 0;
    public $valuePaidReset = 0;
    public $numberPaidReset = 0;

    public function __toString()
    {
        return
            "Vends\t initialisation\t\t reset\n\r" .
            "\t value\t number\t value\t number\n\r" .
            "card:\t " . ($this->valuePaidInit / 100) . "\t $this->numberPaidInit\t " . ($this->valuePaidReset / 100) . "\t $this->numberPaidReset";
    }
}
