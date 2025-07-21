<?php

namespace PeanutPay\PhpEvaDts;

/**
 * DB1 - Database/Device Data Block (Type 1)
 * 
 * Contains database or device-specific information
 * 
 * @package PeanutPay\PhpEvaDts
 */
class DB1DataBlock extends DataBlock implements DataBlockInterface
{
    /** @var string Field 1 */
    public $field1;
    
    /** @var string Field 2 */
    public $field2;
    
    /** @var string Field 3 */
    public $field3;
    
    /** @var array Field assignment mapping */
    const ASSIGNMENT = [
        0 => "cmdType",
        1 => "field1",
        2 => "field2",
        3 => "field3"
    ];
}
