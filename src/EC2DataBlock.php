<?php
namespace PeanutPay\PhpEvaDts;

/**
 * EC2 - Configuration Change Record
 *
 * Records configuration changes made to the vending machine,
 * including when, what was changed, and by whom.
 *
 * @package PeanutPay\PhpEvaDts
 */
class EC2DataBlock extends DataBlock implements DataBlockInterface
{
    const ASSIGNMENT = [
        0 => '',
        1 => 'configurationId',
        2 => 'configurationDate',
        3 => 'configurationTime',
        4 => 'previousValue',
        5 => 'newValue',
        6 => 'operatorId',
    ];

    /** @var string Configuration identifier */
    public $configurationId = '';

    /** @var string Date of configuration change (YYMMDD or YYYYMMDD) */
    public $configurationDate = '';

    /** @var string Time of configuration change (HHmm or HHmmss) */
    public $configurationTime = '';

    /** @var string Previous configuration value */
    public $previousValue = '';

    /** @var string New configuration value */
    public $newValue = '';

    /** @var string Operator who made the change */
    public $operatorId = '';

    public function __toString()
    {
        return "EC2 Config Change [$this->configurationId]: " .
            "$this->previousValue -> $this->newValue on $this->configurationDate $this->configurationTime" .
            (!empty($this->operatorId) ? " by $this->operatorId" : '');
    }
}
