<?php

namespace PeanutPay\PhpEvaDts;

/**
 * VF61 - Vend Flag DataBlock
 * Handles Vend Flag with field VF6111
 */
class VF61DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "",
        2 => "",
        3 => "",
        4 => "",
        5 => "",
        6 => "",
        7 => "",
        8 => "",
        9 => "",
        10 => "",
        11 => "vendFlag", // VF6111: Vend Flag
    ];

    public $vendFlag;
}