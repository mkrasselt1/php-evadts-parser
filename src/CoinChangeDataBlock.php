<?php

namespace PeanutPay\PhpEvaDts;

class CoinChangeDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "vendValueLastRest",
        2 => "vendValueInInit",
    ];

    public $vendValueLastRest = 0;
    public $vendValueInInit = 0;

    public function __toString()
    {
        return "vends with exact change:\t " . ($this->vendValueLastRest / 100) . "\t " . ($this->vendValueInInit / 100) ;
    }
}
