<?php
namespace PeanutPay\PhpEvaDts;

/**
 * EA5 - Event Activity Duration
 *
 * Tracks cumulative event activity: how often and how long
 * a specific event has occurred since initialisation and since last reset.
 *
 * @package PeanutPay\PhpEvaDts
 */
class EA5DataBlock extends DataBlock implements DataBlockInterface
{
    const ASSIGNMENT = [
        0 => '',
        1 => 'eventCode',
        2 => 'numberOccurrencesInit',
        3 => 'numberOccurrencesReset',
        4 => 'cumulativeDurationInit',
        5 => 'cumulativeDurationReset',
    ];

    /** @var string Event code being reported */
    public $eventCode = '';

    /** @var int Number of occurrences since initialisation */
    public $numberOccurrencesInit = 0;

    /** @var int Number of occurrences since last reset */
    public $numberOccurrencesReset = 0;

    /** @var int Cumulative duration in seconds since initialisation */
    public $cumulativeDurationInit = 0;

    /** @var int Cumulative duration in seconds since last reset */
    public $cumulativeDurationReset = 0;

    public function __toString()
    {
        return "EA5 Event Activity [$this->eventCode]: " .
            $this->numberOccurrencesInit . "x / " . $this->cumulativeDurationInit . "s since init, " .
            $this->numberOccurrencesReset . "x / " . $this->cumulativeDurationReset . "s since reset";
    }
}
