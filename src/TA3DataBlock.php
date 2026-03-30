<?php

namespace PeanutPay\PhpEvaDts;

/**
 * TA3 - Value of Cash to Machine
 *
 * Net cash flow into the machine since initialisation and since last reset.
 *
 * @package PeanutPay\PhpEvaDts
 */
class TA3DataBlock extends DataBlock implements DataBlockInterface
{
    const ASSIGNMENT = [
        0 => '',
        1 => 'valueCashToMachineInit',
        2 => 'valueCashToMachineReset',
    ];

    /** @var int Value of cash to machine since initialisation (cents) */
    public $valueCashToMachineInit = 0;

    /** @var int Value of cash to machine since last reset (cents) */
    public $valueCashToMachineReset = 0;

    public function __toString()
    {
        return "TA3 Cash to Machine: " .
            ($this->valueCashToMachineInit / 100) . " EUR since init, " .
            ($this->valueCashToMachineReset / 100) . " EUR since reset";
    }
}
