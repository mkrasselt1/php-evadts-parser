<?php
namespace PeanutPay\PhpEvaDts;

/**
 * PA5 - Product Discount Vends
 *
 * Per-product discount vend counters (number and value)
 * since initialisation and since last reset.
 *
 * @package PeanutPay\PhpEvaDts
 */
class PA5DataBlock extends DataBlock implements DataBlockInterface
{
    const ASSIGNMENT = [
        0 => '',
        1 => 'numberDiscountVendsInit',
        2 => 'valueDiscountVendsInit',
        3 => 'numberDiscountVendsReset',
        4 => 'valueDiscountVendsReset',
    ];

    /** @var int Number of discount paid vends since initialisation */
    public $numberDiscountVendsInit = 0;

    /** @var int Value of discount paid vends since initialisation (cents) */
    public $valueDiscountVendsInit = 0;

    /** @var int Number of discount paid vends since last reset */
    public $numberDiscountVendsReset = 0;

    /** @var int Value of discount paid vends since last reset (cents) */
    public $valueDiscountVendsReset = 0;

    public function __toString()
    {
        return "PA5 Discount Vends: " .
            $this->numberDiscountVendsInit . "x / " . ($this->valueDiscountVendsInit / 100) . " EUR since init, " .
            $this->numberDiscountVendsReset . "x / " . ($this->valueDiscountVendsReset / 100) . " EUR since reset";
    }
}
