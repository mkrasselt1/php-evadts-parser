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
            implode("\t", [
                "last Reset",
                "",
                "",
                "",
                "initialization",
                "",
                "",
                "",
                "",
            ]) . "\r\n" .
            implode("\t", [
                "cash",
                "2box",
                "2tube",
                "bills",
                "2recy",
                "cash",
                "2box",
                "2tube",
                "bills",
                "2ecy",
            ]) . "\r\n" .
            implode("\t", [
                ($this->cashInSinceLastReset / 100),
                ($this->cashToCashBoxSinceLastReset / 100),
                ($this->cashToTubesSinceLastReset / 100),
                ($this->billsInSinceLastReset / 100),
                ($this->billsToRecyclerSinceLastReset / 100),

                ($this->cashInSinceInitialization / 100),
                ($this->cashToCashBoxSinceInitialization / 100),
                ($this->cashToTubesSinceInitialization / 100),
                ($this->billsInSinceInitialization / 100),
                ($this->billsToRecyclerSinceInitialization / 100),
            ]);
    }
}
