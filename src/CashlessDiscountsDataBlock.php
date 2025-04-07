<?php

namespace PeanutPay\PhpEvaDts;

class CashlessDiscountsDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "discountValueLastRest",
        2 => "numberDiscountLastRest",
        3 => "discountValueInit",
        4 => "numberDiscountInit",
        5 => "surchargeValueLastRest",
        6 => "numberSurchargeLastRest",
        7 => "surchargeValueInit",
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
            "cashless discounts \t # $this->numberDiscountLastRest => " . ((int)$this->discountValueLastRest / 100) . " \t # $this->numberDiscountInit => " . ((int)$this->discountValueInit / 100) . " \n" .
            "cashless surcharge \t # $this->numberSurchargeLastRest => " . ((int)$this->surchargeValueLastRest / 100) . " \t # $this->numberSurchargeInit => " . ((int)$this->surchargeValueInit / 100) . "";
    }
}
