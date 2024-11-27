<?php

namespace PeanutPay\PhpEvaDts;

class CashBagDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "bagNumber",
    ];

    public $bagNumber = "";

    public function __toString()
    {
        return "cash bag: $this->bagNumber";
    }
}
