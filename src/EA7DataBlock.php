<?php

namespace PeanutPay\PhpEvaDts;

/**
 * EA7 - Event Audit Data Block (Type 7)
 * 
 * Contains event audit information with counters
 * 
 * @package PeanutPay\PhpEvaDts
 */
class EA7DataBlock extends DataBlock implements DataBlockInterface
{
    /** @var string Event count */
    public $eventCount;
    
    /** @var string Duration or secondary count */
    public $duration;
    
    /** @var array Field assignment mapping */
    const ASSIGNMENT = [
        0 => "cmdType",
        1 => "eventCount",
        2 => "duration"
    ];
}
