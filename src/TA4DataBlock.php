<?php
namespace PeanutPay\PhpEvaDts;

/**
 * TA4 Data Block Class
 * Time audit data block type 4
 */
class TA4DataBlock extends DataBlock implements DataBlockInterface
{
    const ASSIGNMENT = [
        'cmdType',
        'field1',
        'field2',
        'field3',
        'field4',
        'field5',
        'field6',
        'field7',
        'field8'
    ];

    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    public function getField1()
    {
        return $this->data[1] ?? '';
    }

    public function getField2()
    {
        return $this->data[2] ?? '';
    }
}
