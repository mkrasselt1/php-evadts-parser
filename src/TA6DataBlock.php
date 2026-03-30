<?php
namespace PeanutPay\PhpEvaDts;

/**
 * TA6 - Value of Cashless 2 Sales
 *
 * Contains cashless device 2 sales counters (value and number)
 * since initialisation and since last reset.
 *
 * @package PeanutPay\PhpEvaDts
 */
class TA6DataBlock extends DataBlock implements DataBlockInterface
{
    const ASSIGNMENT = [
        0 => '',
        1 => 'valueCashless2SalesInit',
        2 => 'numberCashless2SalesInit',
        3 => 'valueCashless2SalesReset',
        4 => 'numberCashless2SalesReset',
    ];

    /** @var int Value of cashless 2 sales since initialisation (cents) */
    public $valueCashless2SalesInit = 0;

    /** @var int Number of cashless 2 sales since initialisation */
    public $numberCashless2SalesInit = 0;

    /** @var int Value of cashless 2 sales since last reset (cents) */
    public $valueCashless2SalesReset = 0;

    /** @var int Number of cashless 2 sales since last reset */
    public $numberCashless2SalesReset = 0;

    public function __toString()
    {
        return "TA6 Cashless 2 Sales: " .
            ($this->valueCashless2SalesInit / 100) . " EUR (" . $this->numberCashless2SalesInit . "x) since init, " .
            ($this->valueCashless2SalesReset / 100) . " EUR (" . $this->numberCashless2SalesReset . "x) since reset";
    }
}
