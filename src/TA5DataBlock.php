<?php

namespace PeanutPay\PhpEvaDts;

/**
 * TA5 - Value of Cashless 1 Sales
 *
 * Cashless device 1 sales value since initialisation and since last reset.
 *
 * @package PeanutPay\PhpEvaDts
 */
class TA5DataBlock extends DataBlock implements DataBlockInterface
{
    const ASSIGNMENT = [
        0 => '',
        1 => 'valueCashless1SalesInit',
        2 => 'valueCashless1SalesReset',
    ];

    /** @var int Value of cashless 1 sales since initialisation (cents) */
    public $valueCashless1SalesInit = 0;

    /** @var int Value of cashless 1 sales since last reset (cents) */
    public $valueCashless1SalesReset = 0;

    public function __toString()
    {
        return "TA5 Cashless 1 Sales: " .
            ($this->valueCashless1SalesInit / 100) . " EUR since init, " .
            ($this->valueCashless1SalesReset / 100) . " EUR since reset";
    }
}
