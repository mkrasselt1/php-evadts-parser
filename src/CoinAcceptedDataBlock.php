<?php

namespace PeanutPay\PhpEvaDts;

class CoinAcceptedDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "",
        1 => "coinValue",                    // CA1101: Value of Accepted Coin
        2 => "coinsAcceptedSinceReset",      // CA1102: Number of Coins Since Last Reset
        3 => "coinsToCashboxSinceReset",     // CA1103: Number of Coins To Cashbox Since Last Reset
        4 => "coinsToTubesSinceReset",       // CA1104: Number of Coins To Tubes Since Last Reset
        5 => "coinsAcceptedSinceInit",       // CA1105: Number of Coins Since Initialisation
        6 => "coinsToCashboxSinceInit",      // CA1106: Number of Coins To Cashbox Since Initialisation
        7 => "coinsToTubesSinceInit",        // CA1107: Number of Coins To Tubes Since Initialisation
        8 => "coinAge",                      // CA1108: Coin Age
        9 => "coinCountryCode",              // CA1109: Coin Country Code
    ];

    public $coinValue;
    public $coinsAcceptedSinceReset;
    public $coinsToCashboxSinceReset;
    public $coinsToTubesSinceReset;
    public $coinsAcceptedSinceInit;
    public $coinsToCashboxSinceInit;
    public $coinsToTubesSinceInit;
    public $coinAge;
    public $coinCountryCode;
}
