<?php

namespace PeanutPay\PhpEvaDts;

class TimeDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "date",
        2 => "time",
        3 => "seconds",
        4 => "daylightSavings",
    ];

    public $date = "";
    public $time = "";
    public $seconds = "";
    public $transmissionNbr = "";
    public $daylightSavings = "";

    public function __toString()
    {
        if (strlen($this->date) == 6) {
            $this->date = (\DateTimeImmutable::createFromFormat('ymd', $this->date))->format("d-m-Y");
        } else {
            $this->date = (\DateTimeImmutable::createFromFormat('Ymd', $this->date))->format("d-m-Y");
        }
        if (strlen($this->time) == 4) {
            $this->time = (\DateTimeImmutable::createFromFormat('Hi', $this->time))->format("H:i");
        } else {
            $this->time = (\DateTimeImmutable::createFromFormat('His', $this->time))->format("H:i:s");
        }
        return "Date $this->date Time $this->time.$this->seconds (daylight savings $this->daylightSavings)";
    }
}
