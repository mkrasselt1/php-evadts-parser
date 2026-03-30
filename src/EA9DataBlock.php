<?php
namespace PeanutPay\PhpEvaDts;

/**
 * EA9 - Extended Event Configuration
 *
 * Contains extended event configuration data, typically used
 * for event-specific parameter settings or thresholds.
 *
 * @package PeanutPay\PhpEvaDts
 */
class EA9DataBlock extends DataBlock implements DataBlockInterface
{
    const ASSIGNMENT = [
        0 => '',
        1 => 'configType',
        2 => 'configValue',
    ];

    /** @var string Configuration parameter type */
    public $configType = '';

    /** @var string Configuration value */
    public $configValue = '';

    public function __toString()
    {
        return "EA9 Event Config: type=$this->configType value=$this->configValue";
    }
}
