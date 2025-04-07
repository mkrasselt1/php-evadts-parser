<?php

namespace PeanutPay\PhpEvaDts;

class CashReportDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        1 => 'cashInSinceLastReset',
        2 => 'cashToCashBoxSinceLastReset',
        3 => 'cashToTubesSinceLastReset',
        4 => 'billsInSinceLastReset',
        5 => 'cashInSinceInitialization',
        6 => 'cashToCashBoxSinceInitialization',
        7 => 'cashToTubesSinceInitialization',
        8 => 'billsInSinceInitialization',
        9 => 'billsInSinceLastReset',
        10 => 'billsInSinceInitialization',
        11 => 'billsToRecyclerSinceLastReset',
        12 => 'billsToRecyclerSinceInitialization',
    ];

    public $cashInSinceLastReset;
    public $cashToCashBoxSinceLastReset;
    public $cashToTubesSinceLastReset;
    public $billsInSinceLastReset;
    public $cashInSinceInitialization;
    public $cashToCashBoxSinceInitialization;
    public $cashToTubesSinceInitialization;
    public $billsInSinceInitialization;
    public $billsToRecyclerSinceLastReset;
    public $billsToRecyclerSinceInitialization;

    public function __toString()
    {
        return
            "cash\t initialization\t\t reset\n\r" .
            "    \t  value         \t\t number\n\r" .
            "cash:\t " . ($this->cashInSinceLastReset / 100) . "\t\t " . ($this->cashInSinceInitialization / 100) . "\t\r\n" .
            "2box:\t " . ($this->cashToCashBoxSinceLastReset / 100) . "\t\t " . ($this->cashToCashBoxSinceInitialization / 100) . "\t\r\n" .
            "2tube:\t " . ($this->cashToTubesSinceLastReset / 100) . "\t\t " . ($this->cashToTubesSinceInitialization / 100) . "\t\r\n" .
            "bills:\t " . ($this->billsInSinceLastReset / 100) . "\t\t " . ($this->billsInSinceInitialization / 100) . "\t\r\n" .
            "2recy:\t " . ($this->billsToRecyclerSinceLastReset / 100) . "\t\t " . ($this->billsToRecyclerSinceInitialization / 100) . "\t\r\n";
    }
}
