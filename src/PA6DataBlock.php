<?php
namespace PeanutPay\PhpEvaDts;

/**
 * PA6 Data Block Class
 * Product name/description block
 */
class PA6DataBlock extends DataBlock implements DataBlockInterface
{
    const ASSIGNMENT = [
        'cmdType',
        'productNumber',
        'productName'
    ];

    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    public function getProductNumber()
    {
        return $this->data[1] ?? '';
    }

    public function getProductName()
    {
        return $this->data[2] ?? '';
    }
}
