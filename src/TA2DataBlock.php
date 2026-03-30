<?php

namespace PeanutPay\PhpEvaDts;

/**
 * TA2 - Value of Cash Sales
 *
 * Contains cash sales counters (value and number) since initialisation
 * and since last reset, plus optional discount cash sales.
 *
 * @package PeanutPay\PhpEvaDts
 */
class TA2DataBlock extends DataBlock implements DataBlockInterface
{
    const ASSIGNMENT = [
        0 => '',
        1 => 'valueCashSalesInit',
        2 => 'numberCashSalesInit',
        3 => 'valueCashSalesReset',
        4 => 'numberCashSalesReset',
        5 => 'valueDiscountCashSalesInit',
        6 => 'numberDiscountCashSalesInit',
        7 => 'valueDiscountCashSalesReset',
        8 => 'numberDiscountCashSalesReset',
    ];

    /** @var int Value of cash sales since initialisation (cents) */
    public $valueCashSalesInit = 0;

    /** @var int Number of cash sales since initialisation */
    public $numberCashSalesInit = 0;

    /** @var int Value of cash sales since last reset (cents) */
    public $valueCashSalesReset = 0;

    /** @var int Number of cash sales since last reset */
    public $numberCashSalesReset = 0;

    /** @var int Value of discount cash sales since initialisation (cents) */
    public $valueDiscountCashSalesInit = 0;

    /** @var int Number of discount cash sales since initialisation */
    public $numberDiscountCashSalesInit = 0;

    /** @var int Value of discount cash sales since last reset (cents) */
    public $valueDiscountCashSalesReset = 0;

    /** @var int Number of discount cash sales since last reset */
    public $numberDiscountCashSalesReset = 0;

    public function __toString()
    {
        return "TA2 Cash Sales: " .
            ($this->valueCashSalesInit / 100) . " EUR (" . $this->numberCashSalesInit . "x) since init, " .
            ($this->valueCashSalesReset / 100) . " EUR (" . $this->numberCashSalesReset . "x) since reset";
    }
}
