<?php

namespace PeanutPay\PhpEvaDts;

class AuditModuleDataBlock extends DataBlock
{
    const ASSIGNMENT = [
        0 => "", //self::CMD_AUDIT_MODULE,
        1 => "serialNumber",
        2 => "modelNumber",
        3 => "softwareRevision",
        4 => "assetNumber"
    ];

    public $serialNumber        = "";
    public $modelNumber         = "";
    public $softwareRevision    = "";
    public $assetNumber         = "";

    public function __toString()
    {
        return "audit-module $this->assetNumber: $this->modelNumber($this->serialNumber) vers. $this->softwareRevision";
    }
}
