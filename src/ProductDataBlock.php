<?php

namespace PeanutPay\PhpEvaDts;

/**
 * Product Data Block (PA1) - Product Definition and Configuration
 * 
 * Contains product information including name, price, and availability status.
 * This data block defines the products available in the vending machine.
 * 
 * @package PeanutPay\PhpEvaDts
 */
class ProductDataBlock extends DataBlock
{
    /** @var array Field assignment mapping for PA1 format */
    const ASSIGNMENT = [
        0 => "",
        1 => "productNumber",
        2 => "price",
        3 => "name",
        4 => "",
        5 => "",
        6 => "",
        7 => "active",
        8 => "",
    ];
    
    /** @var array Alternative field assignment mapping */
    const ASSIGNMENT_V2 = [
        0 => "",
        1 => "productNumber",
        3 => "price",
        2 => "name",
        4 => "maxCapacity",
        5 => "standardLevel",
        6 => "standardQuantity",
        7 => "active",
        8 => "",
    ];
    

    /** @var int Product identifier/number */
    public $productNumber = 0;
    
    /** @var string Product name/description */
    public $name = "";
    
    /** @var int Product price in cents */
    public $price = 0;
    
    /** @var bool Whether the product is active/available */
    public $active = false;

    public function __toString()
    {
        return "product $this->productNumber names $this->name priced $this->price is " . (!$this->active ? "active" : "inactive") . "\n\r";
    }
}
