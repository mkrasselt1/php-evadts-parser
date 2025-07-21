<?php

namespace PeanutPay\PhpEvaDts;

/**
 * DB2 - Database/Device Data Block (Type 2)
 * 
 * Contains database or device-specific information
 * 
 * @package PeanutPay\PhpEvaDts
 */
class DB2DataBlock extends DataBlock implements DataBlockInterface
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
