<?php
namespace PeanutPay\PhpEvaDts;

/**
 * PA5 Data Block Class
 * Product/price audit block
 */
class PA5DataBlock extends DataBlock implements DataBlockInterface
{
    const ASSIGNMENT = [
        'cmdType',
        'productNumber',
        'field2',
        'field3',
        'field4'
    ];

    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    public function getProductNumber()
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
}
