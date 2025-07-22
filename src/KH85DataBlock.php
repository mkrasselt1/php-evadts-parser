<?php

namespace PeanutPay\PhpEvaDts;

/**
 * KH85 - Key Handler Data DataBlock
 * Handles Key Handler Data with field KH8503
 */
class KH85DataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "",
        2 => "",
        3 => "keyHandlerData", // KH8503: Key Handler Data
    ];

    public $keyHandlerData;
}