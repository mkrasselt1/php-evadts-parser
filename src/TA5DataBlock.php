<?php

namespace PeanutPay\PhpEvaDts;

/**
 * TA5 - Total Audit Data Block (variant)
 * 
 * Contains total audit counters for specific metrics
 * 
 * @package PeanutPay\PhpEvaDts
 */
class TA5DataBlock extends DataBlock implements DataBlockInterface
{
    /** @var string Value init */
    public $valueInit;
    
    /** @var string Value reset */
    public $valueReset;
    
    /** @var array Field assignment mapping */
    const ASSIGNMENT = [
        0 => "cmdType",
        1 => "valueInit",
        2 => "valueReset"
    ];
}
