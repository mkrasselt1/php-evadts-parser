<?php

namespace PeanutPay\PhpEvaDts;

/**
 * EA3 - Event Audit Data Block (Type 3)
 * 
 * Contains event audit information with timestamps
 * 
 * @package PeanutPay\PhpEvaDts
 */
class EA3DataBlock extends DataBlock implements DataBlockInterface
{
    /** @var string Event type/code */
    public $eventType;
    
    /** @var string Start date */
    public $startDate;
    
    /** @var string Start time */
    public $startTime;
    
    /** @var string Duration or count */
    public $duration;
    
    /** @var string End date */
    public $endDate;
    
    /** @var string End time */
    public $endTime;
    
    /** @var string Status */
    public $status;
    
    /** @var array Field assignment mapping */
    const ASSIGNMENT = [
        0 => "cmdType",
        1 => "eventType",
        2 => "startDate",
        3 => "startTime",
        4 => "duration",
        5 => "endDate",
        6 => "endTime",
        7 => "status"
    ];
}
