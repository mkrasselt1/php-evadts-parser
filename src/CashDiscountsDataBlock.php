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

    public $discountValueLastRest = 0;
    public $discountValueInit = 0;
    public $numberDiscountLastRest = 0;
    public $numberDiscountInit = 0;
    public $surchargeValueLastRest = 0;
    public $surchargeValueInit = 0;
    public $numberSurchargeLastRest = 0;
    public $numberSurchargeInit = 0;


    public function __toString()
    {
        return 
            "cash discounts \t # $this->numberDiscountLastRest => " . ($this->discountValueLastRest / 100) . " \t # $this->numberDiscountInit => " . ($this->discountValueInit / 100) . " \n" .
            "cash surcharge \t # $this->numberSurchargeLastRest => " . ($this->surchargeValueLastRest / 100) . " \t # $this->numberSurchargeInit => " . ($this->surchargeValueInit / 100) . "";
    }
}
