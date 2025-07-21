<?php
namespace PeanutPay\PhpEvaDts;

/**
 * MA1 Data Block Class
 * Machine audit/information block
 */
class MA1DataBlock extends DataBlock implements DataBlockInterface
{
    const ASSIGNMENT = [
        'cmdType',
        'machineID',
        'checksum'
    ];

    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    public function getMachineID()
    {
        return $this->data[1] ?? '';
    }

    public function getChecksum()
    {
        return $this->data[2] ?? '';
    }
}
