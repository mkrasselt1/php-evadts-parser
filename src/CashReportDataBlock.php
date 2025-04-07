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

    public $cashInSinceLastReset = 0;
    public $cashToCashBoxSinceLastReset = 0;
    public $cashToTubesSinceLastReset = 0;
    public $billsInSinceLastReset = 0;
    public $cashInSinceInitialization = 0;
    public $cashToCashBoxSinceInitialization = 0;
    public $cashToTubesSinceInitialization = 0;
    public $billsInSinceInitialization = 0;
    public $billsToRecyclerSinceLastReset = 0;
    public $billsToRecyclerSinceInitialization = 0;

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
