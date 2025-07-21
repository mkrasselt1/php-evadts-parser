<?php

namespace PeanutPay\PhpEvaDts;

/**
 * EA6 - Extended Event Data Block
 * 
 * Contains extended event information with timestamps and descriptions
 * 
 * @package PeanutPay\PhpEvaDts
 */
class EA6DataBlock extends DataBlock implements DataBlockInterface
{
    /** @var string Event date in YYYYMMDD format */
    public $eventDate;
    
    /** @var string Event time in HHMMSS format */
    public $eventTime;
    
    /** @var string Machine or module identifier */
    public $machineId;
    
    /** @var string Event description */
    public $eventDescription;
    
    /** @var array Field assignment mapping */
    const ASSIGNMENT = [
        0 => "cmdType",
        1 => "eventDate",
        2 => "eventTime", 
        3 => "machineId",
        4 => "eventDescription"
    ];
}
