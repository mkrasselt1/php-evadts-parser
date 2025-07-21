<?php

namespace PeanutPay\PhpEvaDts;

/**
 * Price List Vends Data Block (LA1) - Price List and Sales Counter Data
 * 
 * Contains price list assignments and sales counters for products.
 * This data block tracks which products belong to which price list
 * and maintains paid transaction counters.
 * 
 * @package PeanutPay\PhpEvaDts
 */
class PriceListVendsDataBlock extends DataBlock
{
    /** @var array Field assignment mapping for LA1 format */
    const ASSIGNMENT = [
        0 => "",
        1 => "priceList",
        2 => "productNumber",
        3 => "price",
        4 => "numberPaidInit",
        5 => "numberPaidReset",
    ];

    /** @var int Price list identifier */
    public $priceList = 0;
    
    /** @var int Product number */
    public $productNumber = 0;
    
    /** @var int Product price in cents */
    public $price = 0;
    
    /** @var int Initial paid counter value */
    public $numberPaidInit = 0;
    
    /** @var int Reset paid counter value */
    public $numberPaidReset = 0;

    /**
     * Generate formatted string representation
     * 
     * @param bool $priceListHeader Whether to include header row
     * @return string Formatted price list data
     */
    public function toString(bool $priceListHeader = false)
    {
        return (!$priceListHeader ? "list\tproduct\tcosts\tinitialisation\treset\n\r" : "") .
            "$this->priceList\t $this->productNumber\t$this->price\t$this->numberPaidInit\t$this->numberPaidReset";
    }

    public function __toString()
    {
        return $this->toString();
    }
}
