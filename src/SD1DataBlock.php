<?php

namespace PeanutPay\PhpEvaDts;

/**
 * SD1 - System Data Block
 * 
 * Contains system configuration and status information
 * 
 * @package PeanutPay\PhpEvaDts
 */
class SD1DataBlock extends DataBlock implements DataBlockInterface
{
    /** @var string System data field */
    public $systemData;
    
    /** @var array Field assignment mapping */
    const ASSIGNMENT = [
        0 => "cmdType",
        1 => "systemData"
    ];
}
