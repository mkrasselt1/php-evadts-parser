<?php

namespace PeanutPay\PhpEvaDts;

/**
 * DB10 - Database/Device Data Block (Type 10)
 * 
 * Contains database or device-specific information
 * 
 * @package PeanutPay\PhpEvaDts
 */
class DB10DataBlock extends DataBlock implements DataBlockInterface
{
    /** @var string Field 1 */
    public $field1;
    
    /** @var string Field 2 */
    public $field2;
    
    /** @var string Field 3 */
    public $field3;
    
    /** @var string Field 4 */
    public $field4;
    
    /** @var array Field assignment mapping */
    const ASSIGNMENT = [
        0 => "cmdType",
        1 => "field1",
        2 => "field2",
        3 => "field3",
        4 => "field4"
    ];
}
