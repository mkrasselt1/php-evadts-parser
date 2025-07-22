<?php

namespace PeanutPay\PhpEvaDts;

/**
 * EF15 - Extension Field 15 DataBlock
 * Handles extension field information with 1 field (EF1544)
 */
class EF15DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "", 2 => "", 3 => "", 4 => "", 5 => "", 6 => "", 7 => "", 8 => "", 9 => "",
        10 => "", 11 => "", 12 => "", 13 => "", 14 => "", 15 => "", 16 => "", 17 => "", 18 => "", 19 => "",
        20 => "", 21 => "", 22 => "", 23 => "", 24 => "", 25 => "", 26 => "", 27 => "", 28 => "", 29 => "",
        30 => "", 31 => "", 32 => "", 33 => "", 34 => "", 35 => "", 36 => "", 37 => "", 38 => "", 39 => "",
        40 => "", 41 => "", 42 => "", 43 => "",
        44 => "extensionData",              // EF1544: Extension Data
    ];

    public $extensionData;
}
