<?php
namespace PeanutPay\PhpEvaDts;

/**
 * MA1 Data Block Class
 * Machine audit/information block
 */
class MA1DataBlock extends DataBlock implements DataBlockInterface
{
    const ASSIGNMENT = [
        0 => '',
        1 => 'machineID',
        2 => 'checksum',
    ];

    public $machineID = '';
    public $checksum = '';
}
