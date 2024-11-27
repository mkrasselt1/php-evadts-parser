<?php

namespace PeanutPay\PhpEvaDts;

class CurrencyDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "", //self::CMD_TRANSACTION_SET,
        1 => "decimals",
        2 => "currencyCodeNumeric",
        3 => "currencyCode",
    ];

    public $decimals = "";
    public $currencyCodeNumeric = "";
    public $currencyCode = "";

    public function __toString()
    {
        return "currency: $this->currencyCode ($this->currencyCodeNumeric) with $this->decimals decimals";
    }
}
