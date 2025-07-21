<?php

namespace PeanutPay\PhpEvaDts;

/**
 * DXE - Data Exchange End Data Block
 * 
 * Indicates the end of data exchange with status information
 * 
 * @package PeanutPay\PhpEvaDts
 */
class DXEDataBlock extends DataBlock implements DataBlockInterface
{
    /** @var string Exchange status */
    public $exchangeStatus;
    
    /** @var string Exchange mode */
    public $exchangeMode;
    
    /** @var array Field assignment mapping */
    const ASSIGNMENT = [
        0 => "cmdType",
        1 => "exchangeStatus",
        2 => "exchangeMode"
    ];
}
