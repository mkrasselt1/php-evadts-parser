<?php
namespace PeanutPay\PhpEvaDts;

/**
 * EA5 Data Block Class
 * Extended event audit data block
 */
class EA5DataBlock extends DataBlock implements DataBlockInterface
{
    const ASSIGNMENT = [
        'cmdType',
        'value1',
        'value2',
        'value3',
        'value4',
        'value5'
    ];

    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    public function getValue1()
    {
        return $this->data[1] ?? '';
    }

    public function getValue2()
    {
        return $this->data[2] ?? '';
    }

    public function getValue3()
    {
        return $this->data[3] ?? '';
    }

    public function getValue4()
    {
        return $this->data[4] ?? '';
    }

    public function getValue5()
    {
        return $this->data[5] ?? '';
    }
}
