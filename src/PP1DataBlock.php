<?php

namespace PeanutPay\PhpEvaDts;

/**
 * PP1 - Product/Position Data Block
 * 
 * Contains product position and configuration information
 * 
 * @package PeanutPay\PhpEvaDts
 */
class PP1DataBlock extends DataBlock implements DataBlockInterface
{
    /** @var string Product number */
    public $productNumber;
    
    /** @var string Position or status */
    public $position;
    
    /** @var string Product name */
    public $productName;
    
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
    
    /** @var string Field 9 */
    public $field9;
    
    /** @var array Field assignment mapping */
    const ASSIGNMENT = [
        0 => "cmdType",
        1 => "productNumber",
        2 => "position",
        3 => "productName",
        4 => "field4",
        5 => "field5",
        6 => "field6",
        7 => "field7",
        8 => "field8",
        9 => "field9"
    ];
}
