<?php
namespace PeanutPay\PhpEvaDts;

/**
 * EA9 Data Block Class
 * Extended event audit data block type 9
 */
class EA9DataBlock extends DataBlock implements DataBlockInterface
{
    const ASSIGNMENT = [
        'cmdType',
        'eventType',
        'eventData'
    ];

    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    public function getEventType()
    {
        return $this->data[1] ?? '';
    }

    public function getEventData()
    {
        return $this->data[2] ?? '';
    }
}
