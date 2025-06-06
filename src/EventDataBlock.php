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
        $this->eventId = match (\substr($this->eventId, 0, 2)) {
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

            //rhea specific
            "EC_ON" => "device on",
            "OAJ" => "brewer cleansing",
            "OAJ_BRW" => "rinsing brewer",
            "OAJ_MIX" => "rinsing mixer",
            "OAK" => "filter change",
            "OBH" => "waste collection full",
            "OCF" => "device off",

            default => "unknown(" . $this->eventId . ")"
        };
        if (strlen($this->date) == 8) {
            $this->date = (\DateTimeImmutable::createFromFormat('Ymd', $this->date));
        } else {
            $this->date = (\DateTimeImmutable::createFromFormat('ymd', $this->date));
        }
        if (is_object($this->date)  && get_class($this->date) == "DateTimeImmutable") {
            $this->date = $this->date?->format("d-m-Y");
        }

        if (strlen($this->time) == 4) {
            $this->time = (\DateTimeImmutable::createFromFormat('Hi', $this->time));
        } else {
            $this->time = (\DateTimeImmutable::createFromFormat('His', $this->time));
        }
        if (is_object($this->time)  && get_class($this->time) == "DateTimeImmutable") {
            $this->time = $this->time?->format("H:i:s");
        }

        return "event $this->eventId on $this->date $this->time for $this->durationS seconds: $this->payload";
    }
}
