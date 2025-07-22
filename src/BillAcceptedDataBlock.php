<?php

namespace PeanutPay\PhpEvaDts;

class BillAcceptedDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "billValue",  // CA1401: Bill Value in cents
        2 => "billsInSinceReset",  // CA1402: Number of Bills In Since Last Reset  
        3 => "billsToStackerSinceReset",  // CA1403: Number of Bills To Stacker Since Last Reset
        4 => "billsInSinceInit",  // CA1404: Number of Bills In Since Initialisation
        5 => "billsToStackerSinceInit",  // CA1405: Number of Bills To Stacker Since Initialisation
    ];

    public $billValue = 0;
    public $billsInSinceReset = 0;  
    public $billsToStackerSinceReset = 0;
    public $billsInSinceInit = 0;
    public $billsToStackerSinceInit = 0;


    public function __toString()
    {
        return "bill accepted:\t " . ($this->billValue / 100) . " EUR\t" .
               "Reset: {$this->billsInSinceReset} in / {$this->billsToStackerSinceReset} to stacker\t" .
               "Init: {$this->billsInSinceInit} in / {$this->billsToStackerSinceInit} to stacker";
    }
}
