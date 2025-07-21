<?php

namespace PeanutPay\PhpEvaDts;

/**
 * DB5 - Database/Device Data Block (Type 5)
 * 
 * Contains database or device-specific information
 * 
 * @package PeanutPay\PhpEvaDts
 */
class DB5DataBlock extends DataBlock implements DataBlockInterface
{
    /** @var string Field 1 */
    public $field1;
    
    /** @var string Field 2 */
    public $field2;
    
    /** @var string Field 3 */
    public $field3;
    
    /** @var string Field 4 */
    public $field4;
    
    /** @var string Field 5 */
    public $field5;
    
    /** @var string Field 6 */
    public $field6;
    
    /** @var string Field 7 */
    public $field7;
    
    /** @var string Field 8 */
    public $field8;
    
    /** @var array Field assignment mapping */
    const ASSIGNMENT = [
        0 => "cmdType",
        1 => "field1",
        2 => "field2",
        3 => "field3",
        4 => "field4",
        5 => "field5",
        6 => "field6",
        7 => "field7",
        8 => "field8"
    ];
}
