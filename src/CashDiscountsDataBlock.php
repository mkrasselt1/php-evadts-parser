<?php

namespace PeanutPay\PhpEvaDts;

class CashDiscountsDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "discountValueLastRest",
        2 => "discountValueInit",
        3 => "numberDiscountLastRest",
        4 => "numberDiscountInit",
        5 => "surchargeValueLastRest",
        6 => "surchargeValueInit",
        7 => "numberSurchargeLastRest",
        8 => "numberSurchargeInit",
    ];

    public $discountValueLastRest = "";
    public $discountValueInit = "";
    public $numberDiscountLastRest = "";
    public $numberDiscountInit = "";
    public $surchargeValueLastRest = "";
    public $surchargeValueInit = "";
    public $numberSurchargeLastRest = "";
    public $numberSurchargeInit = "";


    public function __toString()
    {
        return 
            "cash discounts \t # $this->numberDiscountLastRest => " . ($this->discountValueLastRest / 100) . " \t # $this->numberDiscountInit => " . ($this->discountValueInit / 100) . " \n" .
            "cash surcharge \t # $this->numberSurchargeLastRest => " . ($this->surchargeValueLastRest / 100) . " \t # $this->numberSurchargeInit => " . ($this->surchargeValueInit / 100) . "";
    }
}
