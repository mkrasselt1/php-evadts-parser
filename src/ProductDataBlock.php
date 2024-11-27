<?php

namespace PeanutPay\PhpEvaDts;

class ProductDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "productNumber",
        2 => "name",
        3 => "price",
        4 => "",
        5 => "",
        6 => "",
        7 => "active",
        8 => "",
    ];
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
    

    public $productNumber = 0;
    public $name = "";
    public $price = 0;
    public $active = false;

    public function __toString()
    {
        return "product $this->productNumber names $this->name priced $this->price is " . (!$this->active ? "active" : "inactive") . "\n\r";
    }
}
