<?php

namespace PeanutPay\PhpEvaDts;

class ProductVendsNewDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0  => "",
        1  => "productNumber",
        2  => "paymentDevice",
        3  => "priceList",
        4  => "price",
        5  => "numberSalesInit",
        6  => "valueSalesInit",
        7  => "numberSalesReset",
        8  => "valueSalesReset",
    ];

    public $productNumber = 0;
    public $valueProductsInit = 0;
    public $paymentDevice = "";
    public $priceList = 0;
    public $price = 0;
    public $numberSalesInit = 0;
    public $valueSalesInit = 0;
    public $numberSalesReset = 0;
    public $valueSalesReset = 0;

    public function toString(bool $header = false)
    {
        return "product #$this->productNumber via $this->paymentDevice at $this->priceList for $this->price" . "\r\n" .
            "since init:\t #$this->numberSalesInit \t " . ($this->valueSalesInit / 100) . "\r\n" .
            "since reset:\t #$this->numberSalesReset \t " . ($this->valueSalesReset / 100) . "\r\n";
    }

    public function __toString()
    {
        return $this->toString(true);
    }
}
