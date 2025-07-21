<?php

namespace PeanutPay\PhpEvaDts;

/**
 * TA2 - Total Audit Data Block
 * 
 * Contains total audit counters and statistics
 * 
 * @package PeanutPay\PhpEvaDts
 */
class TA2DataBlock extends DataBlock implements DataBlockInterface
{
    /** @var string Total value init */
    public $totalValueInit;
    
    /** @var string Total number init */
    public $totalNumberInit;
    
    /** @var string Total value reset */
    public $totalValueReset;
    
    /** @var string Total number reset */
    public $totalNumberReset;
    
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
        1 => "totalValueInit",
        2 => "totalNumberInit",
        3 => "totalValueReset", 
        4 => "totalNumberReset",
        5 => "field5",
        6 => "field6",
        7 => "field7",
        8 => "field8"
    ];
}
