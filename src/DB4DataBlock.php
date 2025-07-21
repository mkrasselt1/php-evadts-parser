<?php

namespace PeanutPay\PhpEvaDts;

/**
 * DB4 - Database/Device Data Block (Type 4)
 * 
 * Contains database or device-specific information
 * 
 * @package PeanutPay\PhpEvaDts
 */
class DB4DataBlock extends DataBlock implements DataBlockInterface
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
