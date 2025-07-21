<?php
namespace PeanutPay\PhpEvaDts;

/**
 * EC2 Data Block Class
 * Error/control audit data block
 */
class EC2DataBlock extends DataBlock implements DataBlockInterface
{
    const ASSIGNMENT = [
        'cmdType',
        'errorCode',
        'field2',
        'field3',
        'field4',
        'field5',
        'field6'
    ];

    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    public function getErrorCode()
    {
        return $this->data[1] ?? '';
    }

    public function getField2()
    {
        return $this->data[2] ?? '';
    }

    public function getField3()
    {
        return $this->data[3] ?? '';
    }

    public function getField4()
    {
        return $this->data[4] ?? '';
    }

    public function getField5()
    {
        return $this->data[5] ?? '';
    }

    public function getField6()
    {
        return $this->data[6] ?? '';
    }
}
