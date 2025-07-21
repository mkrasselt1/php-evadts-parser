<?php

namespace PeanutPay\PhpEvaDts;

/**
 * PA8 - Product Audit Data Block
 * 
 * Contains product audit information and counters
 * 
 * @package PeanutPay\PhpEvaDts
 */
class PA8DataBlock extends DataBlock implements DataBlockInterface
{
    /** @var string Value init */
    public $valueInit;
    
    /** @var string Value reset */
    public $valueReset;
    
    /** @var string Field 3 */
    public $field3;
    
    /** @var string Field 4 */
    public $field4;
    
    /** @var array Field assignment mapping */
    const ASSIGNMENT = [
        0 => "cmdType",
        1 => "valueInit",
        2 => "valueReset",
        3 => "field3",
        4 => "field4"
    ];
}
