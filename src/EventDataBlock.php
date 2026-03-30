<?php

namespace PeanutPay\PhpEvaDts;

class EventDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "", //self::CMD_TRANSACTION_SET,
        1 => "eventId",
        2 => "date",
        3 => "time",
        4 => "durationS",
        5 => "durationMs",
        6 => "payload",
    ];

    public $eventId = "";
    public $date = null;
    public $time = null;
    public $durationS = 0;
    public $durationMs = 0;
    public $payload = "";

    public function __toString()
    {
        $trimmedEventId = trim($this->eventId);
        $eventLabel = match ($trimmedEventId) {
            "DEB" => "debug",
            "PTV" => "product test vend",
            "PVD" => "product vend dispensed",
            "PVE" => "product vend error",
            "EC_ON" => "device on",
            "OAJ" => "brewer cleansing",
            "OAJ_BRW" => "rinsing brewer",
            "OAJ_MIX" => "rinsing mixer",
            "OAK" => "filter change",
            "OBH" => "waste collection full",
            "OCF" => "device off",
            "KONF" => "configuration",
            "RESET" => "system reset",
            default => match (\substr($trimmedEventId, 0, 2)) {
                "EA" => "coin",
                "EB" => "cup",
                "EC" => "control system",
                "ED" => "hot drinks",
                "EE" => "brewer system",
                "EF" => "water",
                "EG" => "cabinet",
                "EH" => "cold drinks",
                "EI" => "communications",
                "EJ" => "snack/can/bottle",
                "EK" => "cashless",
                "EL" => "product",
                "EM" => "microwave",
                "EN" => "bill validator",
                "EO" => "refrigeration",
                "OA" => "request",
                "OB" => "service",
                "OC" => "customer",
                "OD" => "return visits",
                "OE" => "machine history",
                "OF" => "cash collection",
                default => "unknown(" . $trimmedEventId . ")"
            }
        };

        $dateFormatted = $this->date;
        if (is_string($this->date) && !empty($this->date)) {
            if (strlen($this->date) == 8) {
                $dateObj = \DateTimeImmutable::createFromFormat('Ymd', $this->date);
            } else {
                $dateObj = \DateTimeImmutable::createFromFormat('ymd', $this->date);
            }
            if ($dateObj) {
                $dateFormatted = $dateObj->format("d-m-Y");
            }
        }

        $timeFormatted = $this->time;
        if (is_string($this->time) && !empty($this->time)) {
            if (strlen($this->time) == 4) {
                $timeObj = \DateTimeImmutable::createFromFormat('Hi', $this->time);
            } else {
                $timeObj = \DateTimeImmutable::createFromFormat('His', $this->time);
            }
            if ($timeObj) {
                $timeFormatted = $timeObj->format("H:i:s");
            }
        }

        return "event $eventLabel on $dateFormatted $timeFormatted for $this->durationS seconds: $this->payload";
    }
}
