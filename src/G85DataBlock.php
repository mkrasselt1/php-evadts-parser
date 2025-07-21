<?php

namespace PeanutPay\PhpEvaDts;

/**
 * G85 - General Data Block
 * 
 * Contains general/manufacturer-specific data
 * Often used for checksums or proprietary information
 * 
 * @package PeanutPay\PhpEvaDts
 */
class G85DataBlock extends DataBlock implements DataBlockInterface
{
    /** @var string General data value */
    public $generalData;
    
    /** @var array Field assignment mapping */
    const ASSIGNMENT = [
        0 => "cmdType",
        1 => "generalData"
    ];
}
