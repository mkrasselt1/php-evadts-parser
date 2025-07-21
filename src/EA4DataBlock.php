<?php

namespace PeanutPay\PhpEvaDts;

/**
 * EA4 - Event Audit Data Block (Type 4)
 * 
 * Contains event audit information with timestamps
 * 
 * @package PeanutPay\PhpEvaDts
 */
class EA4DataBlock extends DataBlock implements DataBlockInterface
{
    /** @var string Event date */
    public $eventDate;
    
    /** @var string Event time */
    public $eventTime;
    
    /** @var string Event code/type */
    public $eventCode;
    
    /** @var array Field assignment mapping */
    const ASSIGNMENT = [
        0 => "cmdType",
        1 => "eventDate",
        2 => "eventTime",
        3 => "eventCode"
    ];
}
