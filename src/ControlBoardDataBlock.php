<?php

namespace PeanutPay\PhpEvaDts;

class ControlBoardDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "serialNumber",
        2 => "modelNumber",
        3 => "buildStandard"
    ];

    public $serialNumber = "";
    public $modelNumber = "";
    public $buildStandard = "";

    public function __toString()
    {
        return "control board version $this->modelNumber serial $this->serialNumber - build $this->buildStandard";
    }
}
