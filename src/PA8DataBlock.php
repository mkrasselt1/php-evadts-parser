<?php

namespace PeanutPay\PhpEvaDts;

/**
 * PA8 - Product Cashless 2 Vends
 *
 * Per-product cashless device 2 vend counters (number and value)
 * since initialisation and since last reset.
 *
 * @package PeanutPay\PhpEvaDts
 */
class PA8DataBlock extends DataBlock implements DataBlockInterface
{
    const ASSIGNMENT = [
        0 => '',
        1 => 'numberCashless2VendsInit',
        2 => 'valueCashless2VendsInit',
        3 => 'numberCashless2VendsReset',
        4 => 'valueCashless2VendsReset',
    ];

    /** @var int Number of cashless 2 vends since initialisation */
    public $numberCashless2VendsInit = 0;

    /** @var int Value of cashless 2 vends since initialisation (cents) */
    public $valueCashless2VendsInit = 0;

    /** @var int Number of cashless 2 vends since last reset */
    public $numberCashless2VendsReset = 0;

    /** @var int Value of cashless 2 vends since last reset (cents) */
    public $valueCashless2VendsReset = 0;

    public function __toString()
    {
        return "PA8 Cashless 2 Vends: " .
            $this->numberCashless2VendsInit . "x / " . ($this->valueCashless2VendsInit / 100) . " EUR since init, " .
            $this->numberCashless2VendsReset . "x / " . ($this->valueCashless2VendsReset / 100) . " EUR since reset";
    }
}
