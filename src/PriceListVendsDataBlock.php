<?php

namespace PeanutPay\PhpEvaDts;

class PriceListVendsDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "priceList",
        2 => "productNumber",
        3 => "price",
        4 => "numberPaidInit",
        5 => "numberPaidReset",
    ];

    public $priceList = 0;
    public $productNumber = 0;
    public $price = 0;
    public $numberPaidInit = 0;
    public $numberPaidReset = 0;

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
