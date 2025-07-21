<?php

namespace PeanutPay\PhpEvaDts;

/**
 * SE - Session End Data Block
 * 
 * Indicates the end of a data session with control information
 * 
 * @package PeanutPay\PhpEvaDts
 */
class SEDataBlock extends DataBlock implements DataBlockInterface
{
    /** @var string Record count */
    public $recordCount;
    
    /** @var string Control/sequence number */
    public $controlNumber;
    
    /** @var array Field assignment mapping */
    const ASSIGNMENT = [
        0 => "cmdType",
        1 => "recordCount",
        2 => "controlNumber"
    ];
}
