<?php

namespace PeanutPay\PhpEvaDts;

/**
 * WH94 - Warehouse Data DataBlock
 * Handles Warehouse Data with field WH9401
 */
class WH94DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "warehouseData", // WH9401: Warehouse Data
    ];

    public $warehouseData;
}