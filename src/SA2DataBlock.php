<?php

namespace PeanutPay\PhpEvaDts;

/**
 * SA2 - Selection Audit Data Block
 * 
 * Contains selection audit information for individual products
 * 
 * @package PeanutPay\PhpEvaDts
 */
class SA2DataBlock extends DataBlock implements DataBlockInterface
{
    /** @var string Product/selection number */
    public $selectionNumber;
    
    /** @var string Number of selections made */
    public $numberSelections;
    
    /** @var string Additional field */
    public $field3;
    
    /** @var array Field assignment mapping */
    const ASSIGNMENT = [
        0 => "cmdType",
        1 => "selectionNumber", 
        2 => "numberSelections",
        3 => "field3"
    ];
}
