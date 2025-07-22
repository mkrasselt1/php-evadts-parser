<?php

namespace PeanutPay\PhpEvaDts;

/**
 * BC12 - Barcode Block 12 DataBlock
 * Handles barcode information with 1 field (BC1234)
 */
class BC12DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "", 2 => "", 3 => "", 4 => "", 5 => "", 6 => "", 7 => "", 8 => "", 9 => "",
        10 => "", 11 => "", 12 => "", 13 => "", 14 => "", 15 => "", 16 => "", 17 => "", 18 => "", 19 => "",
        20 => "", 21 => "", 22 => "", 23 => "", 24 => "", 25 => "", 26 => "", 27 => "", 28 => "", 29 => "",
        30 => "", 31 => "", 32 => "", 33 => "",
        34 => "barcodeData",                // BC1234: Barcode Data
    ];

    public $barcodeData;
}
