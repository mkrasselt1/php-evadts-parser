<?php
namespace PeanutPay\PhpEvaDts;

/**
 * TA4 - Value of Token/Coupon Sales
 *
 * Contains token and coupon sales counters (value and number)
 * since initialisation and since last reset.
 * Fields 5-8 are for value token coupon sales.
 *
 * @package PeanutPay\PhpEvaDts
 */
class TA4DataBlock extends DataBlock implements DataBlockInterface
{
    const ASSIGNMENT = [
        0 => '',
        1 => 'valueTokenSalesInit',
        2 => 'numberTokenSalesInit',
        3 => 'valueTokenSalesReset',
        4 => 'numberTokenSalesReset',
        5 => 'valueValueTokenSalesInit',
        6 => 'numberValueTokenSalesInit',
        7 => 'valueValueTokenSalesReset',
        8 => 'numberValueTokenSalesReset',
    ];

    /** @var int Value of token coupon sales since initialisation (cents) */
    public $valueTokenSalesInit = 0;

    /** @var int Number of token coupon sales since initialisation */
    public $numberTokenSalesInit = 0;

    /** @var int Value of token coupon sales since last reset (cents) */
    public $valueTokenSalesReset = 0;

    /** @var int Number of token coupon sales since last reset */
    public $numberTokenSalesReset = 0;

    /** @var int Value of value token coupon sales since initialisation (cents) */
    public $valueValueTokenSalesInit = 0;

    /** @var int Number of value token coupon sales since initialisation */
    public $numberValueTokenSalesInit = 0;

    /** @var int Value of value token coupon sales since last reset (cents) */
    public $valueValueTokenSalesReset = 0;

    /** @var int Number of value token coupon sales since last reset */
    public $numberValueTokenSalesReset = 0;

    public function __toString()
    {
        return "TA4 Token/Coupon Sales: " .
            ($this->valueTokenSalesInit / 100) . " EUR (" . $this->numberTokenSalesInit . "x) since init, " .
            ($this->valueTokenSalesReset / 100) . " EUR (" . $this->numberTokenSalesReset . "x) since reset";
    }
}
