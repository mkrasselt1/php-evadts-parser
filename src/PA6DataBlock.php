<?php
namespace PeanutPay\PhpEvaDts;

/**
 * PA6 - Product Surcharge Vends
 *
 * Per-product surcharge vend counters (number and value)
 * since initialisation and since last reset.
 *
 * @package PeanutPay\PhpEvaDts
 */
class PA6DataBlock extends DataBlock implements DataBlockInterface
{
    const ASSIGNMENT = [
        0 => '',
        1 => 'numberSurchargeVendsInit',
        2 => 'valueSurchargeVendsInit',
        3 => 'numberSurchargeVendsReset',
        4 => 'valueSurchargeVendsReset',
    ];

    /** @var int Number of surcharge paid vends since initialisation */
    public $numberSurchargeVendsInit = 0;

    /** @var int Value of surcharge paid vends since initialisation (cents) */
    public $valueSurchargeVendsInit = 0;

    /** @var int Number of surcharge paid vends since last reset */
    public $numberSurchargeVendsReset = 0;

    /** @var int Value of surcharge paid vends since last reset (cents) */
    public $valueSurchargeVendsReset = 0;

    public function __toString()
    {
        return "PA6 Surcharge Vends: " .
            $this->numberSurchargeVendsInit . "x / " . ($this->valueSurchargeVendsInit / 100) . " EUR since init, " .
            $this->numberSurchargeVendsReset . "x / " . ($this->valueSurchargeVendsReset / 100) . " EUR since reset";
    }
}
