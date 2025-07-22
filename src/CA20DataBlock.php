<?php

namespace PeanutPay\PhpEvaDts;

/**
 * CA20 - Coin Inventory DataBlock
 * Handles coin inventory information with 9 fields (CA2001-CA2009)
 */
class CA20DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "coinValue",                   // CA2001: Coin Value
        2 => "inventoryLevel",              // CA2002: Inventory Level
        3 => "minimumLevel",                // CA2003: Minimum Level
        4 => "maximumLevel",                // CA2004: Maximum Level
        5 => "reorderLevel",                // CA2005: Reorder Level
        6 => "lastInventoryDate",           // CA2006: Last Inventory Date
        7 => "lastInventoryTime",           // CA2007: Last Inventory Time
        8 => "inventoryStatus",             // CA2008: Inventory Status
        9 => "supplierCode",                // CA2009: Supplier Code
    ];

    public $coinValue;
    public $inventoryLevel;
    public $minimumLevel;
    public $maximumLevel;
    public $reorderLevel;
    public $lastInventoryDate;
    public $lastInventoryTime;
    public $inventoryStatus;
    public $supplierCode;
}
