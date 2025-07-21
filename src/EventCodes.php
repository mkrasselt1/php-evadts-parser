<?php

namespace PeanutPay\PhpEvaDts;

/**
 * EVA-DTS Event Codes Database
 * Based on EVA-DTS 6.1.2 Specification Section C.2.3
 * 
 * This class provides access to predefined event codes and extended event series
 * for comprehensive event interpretation in EVA-DTS systems.
 */
class EventCodes
{
    /**
     * Get predefined EVA-DTS event definitions (hex codes 0x00-0x7F)
     * Based on EVA-DTS 6.1.2 Specification Section C.2.3
     * 
     * @return array Predefined event codes with categories and descriptions
     */
    public static function getPredefinedEvents(): array
    {
        return [
            // System Events (0x00-0x0F)
            '00' => ['category' => 'system', 'severity' => 'info', 'description' => 'System startup'],
            '01' => ['category' => 'system', 'severity' => 'info', 'description' => 'System shutdown'],
            '02' => ['category' => 'system', 'severity' => 'warning', 'description' => 'Power failure'],
            '03' => ['category' => 'system', 'severity' => 'info', 'description' => 'Power restored'],
            '04' => ['category' => 'system', 'severity' => 'info', 'description' => 'Clock set'],
            '05' => ['category' => 'system', 'severity' => 'warning', 'description' => 'Real time clock failure'],
            '06' => ['category' => 'system', 'severity' => 'info', 'description' => 'Data download started'],
            '07' => ['category' => 'system', 'severity' => 'info', 'description' => 'Data download completed'],
            '08' => ['category' => 'system', 'severity' => 'error', 'description' => 'Data download failed'],
            '09' => ['category' => 'system', 'severity' => 'info', 'description' => 'Configuration change'],
            '0A' => ['category' => 'system', 'severity' => 'warning', 'description' => 'Memory error'],
            '0B' => ['category' => 'system', 'severity' => 'info', 'description' => 'Software reset'],
            '0C' => ['category' => 'system', 'severity' => 'warning', 'description' => 'Hardware reset'],
            '0D' => ['category' => 'system', 'severity' => 'info', 'description' => 'Audit reset'],
            '0E' => ['category' => 'system', 'severity' => 'info', 'description' => 'Periodic audit'],
            '0F' => ['category' => 'system', 'severity' => 'warning', 'description' => 'System failure'],

            // Vend Events (0x10-0x1F)
            '10' => ['category' => 'vend', 'severity' => 'info', 'description' => 'Vend request'],
            '11' => ['category' => 'vend', 'severity' => 'info', 'description' => 'Vend successful'],
            '12' => ['category' => 'vend', 'severity' => 'warning', 'description' => 'Vend failed - sold out'],
            '13' => ['category' => 'vend', 'severity' => 'warning', 'description' => 'Vend failed - product jam'],
            '14' => ['category' => 'vend', 'severity' => 'warning', 'description' => 'Vend failed - motor failure'],
            '15' => ['category' => 'vend', 'severity' => 'warning', 'description' => 'Vend failed - insufficient funds'],
            '16' => ['category' => 'vend', 'severity' => 'info', 'description' => 'Test vend'],
            '17' => ['category' => 'vend', 'severity' => 'info', 'description' => 'Free vend'],
            '18' => ['category' => 'vend', 'severity' => 'warning', 'description' => 'Vend timeout'],
            '19' => ['category' => 'vend', 'severity' => 'error', 'description' => 'Vend mechanism fault'],
            '1A' => ['category' => 'vend', 'severity' => 'info', 'description' => 'Product refill'],
            '1B' => ['category' => 'vend', 'severity' => 'warning', 'description' => 'Product empty'],
            '1C' => ['category' => 'vend', 'severity' => 'info', 'description' => 'Product switch opened'],
            '1D' => ['category' => 'vend', 'severity' => 'info', 'description' => 'Product switch closed'],
            '1E' => ['category' => 'vend', 'severity' => 'warning', 'description' => 'Product selection disabled'],
            '1F' => ['category' => 'vend', 'severity' => 'info', 'description' => 'Product selection enabled'],

            // Payment Events (0x20-0x2F)
            '20' => ['category' => 'payment', 'severity' => 'info', 'description' => 'Coin accepted'],
            '21' => ['category' => 'payment', 'severity' => 'info', 'description' => 'Coin rejected'],
            '22' => ['category' => 'payment', 'severity' => 'info', 'description' => 'Bill accepted'],
            '23' => ['category' => 'payment', 'severity' => 'info', 'description' => 'Bill rejected'],
            '24' => ['category' => 'payment', 'severity' => 'info', 'description' => 'Change given'],
            '25' => ['category' => 'payment', 'severity' => 'warning', 'description' => 'Change shortage'],
            '26' => ['category' => 'payment', 'severity' => 'info', 'description' => 'Exact change only mode'],
            '27' => ['category' => 'payment', 'severity' => 'info', 'description' => 'Normal change mode'],
            '28' => ['category' => 'payment', 'severity' => 'info', 'description' => 'Cashless payment'],
            '29' => ['category' => 'payment', 'severity' => 'warning', 'description' => 'Cashless payment failed'],
            '2A' => ['category' => 'payment', 'severity' => 'info', 'description' => 'Coin return pressed'],
            '2B' => ['category' => 'payment', 'severity' => 'info', 'description' => 'Coins returned'],
            '2C' => ['category' => 'payment', 'severity' => 'warning', 'description' => 'Coin mech failure'],
            '2D' => ['category' => 'payment', 'severity' => 'warning', 'description' => 'Bill validator failure'],
            '2E' => ['category' => 'payment', 'severity' => 'warning', 'description' => 'Cashless device failure'],
            '2F' => ['category' => 'payment', 'severity' => 'info', 'description' => 'Payment timeout'],

            // Security Events (0x30-0x3F)
            '30' => ['category' => 'security', 'severity' => 'warning', 'description' => 'Door opened'],
            '31' => ['category' => 'security', 'severity' => 'info', 'description' => 'Door closed'],
            '32' => ['category' => 'security', 'severity' => 'warning', 'description' => 'Cash box removed'],
            '33' => ['category' => 'security', 'severity' => 'info', 'description' => 'Cash box inserted'],
            '34' => ['category' => 'security', 'severity' => 'error', 'description' => 'Tamper detected'],
            '35' => ['category' => 'security', 'severity' => 'warning', 'description' => 'Vandalism attempt'],
            '36' => ['category' => 'security', 'severity' => 'info', 'description' => 'Service mode entered'],
            '37' => ['category' => 'security', 'severity' => 'info', 'description' => 'Service mode exited'],
            '38' => ['category' => 'security', 'severity' => 'warning', 'description' => 'Unauthorized access'],
            '39' => ['category' => 'security', 'severity' => 'info', 'description' => 'Access authorized'],
            '3A' => ['category' => 'security', 'severity' => 'warning', 'description' => 'Alarm activated'],
            '3B' => ['category' => 'security', 'severity' => 'info', 'description' => 'Alarm deactivated'],
            '3C' => ['category' => 'security', 'severity' => 'warning', 'description' => 'Glass broken'],
            '3D' => ['category' => 'security', 'severity' => 'warning', 'description' => 'Machine tilted'],
            '3E' => ['category' => 'security', 'severity' => 'error', 'description' => 'Security breach'],
            '3F' => ['category' => 'security', 'severity' => 'info', 'description' => 'Security system test'],

            // Temperature Events (0x40-0x4F)
            '40' => ['category' => 'temperature', 'severity' => 'warning', 'description' => 'Temperature high'],
            '41' => ['category' => 'temperature', 'severity' => 'warning', 'description' => 'Temperature low'],
            '42' => ['category' => 'temperature', 'severity' => 'info', 'description' => 'Temperature normal'],
            '43' => ['category' => 'temperature', 'severity' => 'error', 'description' => 'Cooling system failure'],
            '44' => ['category' => 'temperature', 'severity' => 'error', 'description' => 'Heating system failure'],
            '45' => ['category' => 'temperature', 'severity' => 'warning', 'description' => 'Defrost cycle started'],
            '46' => ['category' => 'temperature', 'severity' => 'info', 'description' => 'Defrost cycle completed'],
            '47' => ['category' => 'temperature', 'severity' => 'warning', 'description' => 'Compressor failure'],
            '48' => ['category' => 'temperature', 'severity' => 'warning', 'description' => 'Fan failure'],
            '49' => ['category' => 'temperature', 'severity' => 'warning', 'description' => 'Temperature sensor failure'],
            '4A' => ['category' => 'temperature', 'severity' => 'info', 'description' => 'Energy saving mode'],
            '4B' => ['category' => 'temperature', 'severity' => 'info', 'description' => 'Normal operation mode'],
            '4C' => ['category' => 'temperature', 'severity' => 'warning', 'description' => 'Condenser dirty'],
            '4D' => ['category' => 'temperature', 'severity' => 'error', 'description' => 'Refrigerant leak'],
            '4E' => ['category' => 'temperature', 'severity' => 'warning', 'description' => 'Door seal failure'],
            '4F' => ['category' => 'temperature', 'severity' => 'info', 'description' => 'Temperature calibration'],

            // Communication Events (0x50-0x5F)
            '50' => ['category' => 'communication', 'severity' => 'info', 'description' => 'Communication established'],
            '51' => ['category' => 'communication', 'severity' => 'warning', 'description' => 'Communication lost'],
            '52' => ['category' => 'communication', 'severity' => 'error', 'description' => 'Communication failure'],
            '53' => ['category' => 'communication', 'severity' => 'info', 'description' => 'Data transmission started'],
            '54' => ['category' => 'communication', 'severity' => 'info', 'description' => 'Data transmission completed'],
            '55' => ['category' => 'communication', 'severity' => 'warning', 'description' => 'Data transmission failed'],
            '56' => ['category' => 'communication', 'severity' => 'info', 'description' => 'Network connected'],
            '57' => ['category' => 'communication', 'severity' => 'warning', 'description' => 'Network disconnected'],
            '58' => ['category' => 'communication', 'severity' => 'warning', 'description' => 'Signal strength low'],
            '59' => ['category' => 'communication', 'severity' => 'info', 'description' => 'Signal strength good'],
            '5A' => ['category' => 'communication', 'severity' => 'warning', 'description' => 'Protocol error'],
            '5B' => ['category' => 'communication', 'severity' => 'warning', 'description' => 'Checksum error'],
            '5C' => ['category' => 'communication', 'severity' => 'info', 'description' => 'Firmware update started'],
            '5D' => ['category' => 'communication', 'severity' => 'info', 'description' => 'Firmware update completed'],
            '5E' => ['category' => 'communication', 'severity' => 'error', 'description' => 'Firmware update failed'],
            '5F' => ['category' => 'communication', 'severity' => 'info', 'description' => 'Remote diagnostic'],

            // Maintenance Events (0x60-0x6F)
            '60' => ['category' => 'maintenance', 'severity' => 'info', 'description' => 'Cleaning cycle started'],
            '61' => ['category' => 'maintenance', 'severity' => 'info', 'description' => 'Cleaning cycle completed'],
            '62' => ['category' => 'maintenance', 'severity' => 'warning', 'description' => 'Filter replacement needed'],
            '63' => ['category' => 'maintenance', 'severity' => 'warning', 'description' => 'Maintenance required'],
            '64' => ['category' => 'maintenance', 'severity' => 'info', 'description' => 'Maintenance performed'],
            '65' => ['category' => 'maintenance', 'severity' => 'warning', 'description' => 'Service interval exceeded'],
            '66' => ['category' => 'maintenance', 'severity' => 'info', 'description' => 'Diagnostic test started'],
            '67' => ['category' => 'maintenance', 'severity' => 'info', 'description' => 'Diagnostic test passed'],
            '68' => ['category' => 'maintenance', 'severity' => 'warning', 'description' => 'Diagnostic test failed'],
            '69' => ['category' => 'maintenance', 'severity' => 'warning', 'description' => 'Component wear detected'],
            '6A' => ['category' => 'maintenance', 'severity' => 'warning', 'description' => 'Lubrication needed'],
            '6B' => ['category' => 'maintenance', 'severity' => 'info', 'description' => 'Calibration completed'],
            '6C' => ['category' => 'maintenance', 'severity' => 'warning', 'description' => 'Calibration required'],
            '6D' => ['category' => 'maintenance', 'severity' => 'warning', 'description' => 'Part replacement needed'],
            '6E' => ['category' => 'maintenance', 'severity' => 'info', 'description' => 'Preventive maintenance'],
            '6F' => ['category' => 'maintenance', 'severity' => 'info', 'description' => 'Maintenance log entry'],

            // User Interface Events (0x70-0x7F)
            '70' => ['category' => 'ui', 'severity' => 'info', 'description' => 'Display message'],
            '71' => ['category' => 'ui', 'severity' => 'warning', 'description' => 'Display failure'],
            '72' => ['category' => 'ui', 'severity' => 'info', 'description' => 'Button pressed'],
            '73' => ['category' => 'ui', 'severity' => 'warning', 'description' => 'Button stuck'],
            '74' => ['category' => 'ui', 'severity' => 'info', 'description' => 'Selection made'],
            '75' => ['category' => 'ui', 'severity' => 'warning', 'description' => 'Invalid selection'],
            '76' => ['category' => 'ui', 'severity' => 'info', 'description' => 'Audio alert'],
            '77' => ['category' => 'ui', 'severity' => 'warning', 'description' => 'Audio system failure'],
            '78' => ['category' => 'ui', 'severity' => 'info', 'description' => 'Language changed'],
            '79' => ['category' => 'ui', 'severity' => 'info', 'description' => 'Price display updated'],
            '7A' => ['category' => 'ui', 'severity' => 'warning', 'description' => 'Keypad failure'],
            '7B' => ['category' => 'ui', 'severity' => 'info', 'description' => 'Illumination on'],
            '7C' => ['category' => 'ui', 'severity' => 'info', 'description' => 'Illumination off'],
            '7D' => ['category' => 'ui', 'severity' => 'warning', 'description' => 'LED failure'],
            '7E' => ['category' => 'ui', 'severity' => 'info', 'description' => 'Screen saver activated'],
            '7F' => ['category' => 'ui', 'severity' => 'info', 'description' => 'User interaction timeout']
        ];
    }

    /**
     * Get extended coin acceptor event codes (EA + letter)
     * 
     * @return array Coin acceptor event codes
     */
    public static function getCoinEvents(): array
    {
        return [
            'A' => 'Coin acceptor initialized',
            'B' => 'Coin acceptor busy',
            'C' => 'Coin acceptor cash box full',
            'D' => 'Coin acceptor disabled',
            'E' => 'Coin acceptor enabled',
            'F' => 'Coin acceptor fault',
            'G' => 'Coin acceptor general error',
            'H' => 'Coin acceptor hopper empty',
            'I' => 'Coin acceptor inhibited',
            'J' => 'Coin acceptor jam detected',
            'K' => 'Coin acceptor key missing',
            'L' => 'Coin acceptor low credit',
            'M' => 'Coin acceptor maintenance required',
            'N' => 'Coin acceptor not ready',
            'O' => 'Coin mech control PCB has failed',
            'P' => 'Coin acceptor payment successful',
            'Q' => 'Coin acceptor queue full',
            'R' => 'Coin acceptor reset',
            'S' => 'Coin acceptor service mode',
            'T' => 'Coin acceptor timeout',
            'U' => 'Coin acceptor unspecified error',
            'V' => 'Coin acceptor validation error',
            'W' => 'Coin acceptor warning',
            'X' => 'Coin acceptor exchange error',
            'Y' => 'Coin acceptor yield problem',
            'Z' => 'Coin acceptor zone error'
        ];
    }

    /**
     * Get extended cup dispenser event codes (EB + letter)
     * 
     * @return array Cup dispenser event codes
     */
    public static function getCupEvents(): array
    {
        return [
            'A' => 'Cup dispenser available',
            'B' => 'Cup dispenser blocked',
            'C' => 'Cup dispenser empty',
            'D' => 'Cup dispenser disabled',
            'E' => 'Cup dispenser enabled',
            'F' => 'Cup dispenser fault',
            'G' => 'Cup dispenser general error',
            'H' => 'Cup dispenser hopper problem',
            'I' => 'Cup dispenser inhibited',
            'J' => 'Cup dispenser jam',
            'K' => 'Cup dispenser key position',
            'L' => 'Cup dispenser low level',
            'M' => 'Cup dispenser motor fault',
            'N' => 'Cup dispenser not ready',
            'O' => 'Cup dispenser out of service',
            'P' => 'Cup dispenser position error',
            'Q' => 'Cup dispenser quality check',
            'R' => 'Cup dispenser reset',
            'S' => 'Cup dispenser sensor fault',
            'T' => 'Cup dispenser timeout',
            'U' => 'Cup dispenser unknown error'
        ];
    }

    /**
     * Get extended control board event codes (EC + letter)
     * 
     * @return array Control board event codes
     */
    public static function getControlEvents(): array
    {
        return [
            'A' => 'Control board active',
            'B' => 'Control board boot error',
            'C' => 'Control board communication error',
            'D' => 'Control board data error',
            'E' => 'Control board emergency stop',
            'F' => 'Control board firmware error',
            'G' => 'Control board general fault',
            'H' => 'Control board hardware fault',
            'I' => 'Control board initialization',
            'J' => 'Control board jam protection',
            'K' => 'Control board key error',
            'L' => 'Control board link error',
            'M' => 'Control board memory error',
            'N' => 'Control board network error',
            'O' => 'Control board operational error',
            'P' => 'Control board power fault',
            'Q' => 'Control board quality check failed',
            'R' => 'Control board restart',
            'S' => 'Control board system error',
            'T' => 'Control board temperature fault',
            'U' => 'Control board unknown error',
            'V' => 'Control board voltage error',
            'W' => 'Control board watchdog timeout',
            'X' => 'Control board execution error',
            'Y' => 'Control board synchronization error',
            'Z' => 'Control board zone fault'
        ];
    }

    /**
     * Get extended cabinet event codes (EG + letter)
     * 
     * @return array Cabinet event codes
     */
    public static function getCabinetEvents(): array
    {
        return [
            'A' => 'Cabinet alarm activated',
            'B' => 'Cabinet back door opened',
            'C' => 'Cabinet cooling failure',
            'D' => 'Cabinet door opened',
            'E' => 'Cabinet electrical fault',
            'F' => 'Cabinet front panel fault',
            'G' => 'Cabinet glass broken',
            'H' => 'Cabinet heating failure',
            'I' => 'Cabinet illumination fault',
            'J' => 'Cabinet jam detected',
            'K' => 'Cabinet key switch',
            'L' => 'Cabinet lock fault',
            'M' => 'Cabinet motor fault',
            'N' => 'Cabinet not secured',
            'O' => 'Cabinet opened unauthorized',
            'P' => 'Cabinet power failure',
            'Q' => 'Cabinet quality sensor fault',
            'R' => 'Cabinet refrigeration fault',
            'S' => 'Cabinet security breach',
            'T' => 'Cabinet temperature fault',
            'U' => 'Cabinet unauthorized access',
            'V' => 'Cabinet vibration detected',
            'W' => 'Cabinet water leak detected',
            'X' => 'Cabinet external fault',
            'Y' => 'Cabinet system fault',
            'Z' => 'Cabinet zone alarm'
        ];
    }

    /**
     * Get extended communication event codes (EI + letter) - Table 9: COMMUNICATIONS
     * 
     * @return array Communication event codes
     */
    public static function getCommunicationEvents(): array
    {
        return [
            'A' => 'No modem / radio detected in system',
            'B' => 'Communication buffer full',
            'C' => 'Communication connection lost',
            'D' => 'Communication data error',
            'E' => 'Communication error occurred',
            'F' => 'Communication failure',
            'G' => 'Communication general fault',
            'H' => 'Communication handshake failed',
            'I' => 'Communication interface error',
            'J' => 'Communication jam in protocol',
            'K' => 'Communication key exchange failed',
            'L' => 'Communication line busy',
            'M' => 'Communication modem error',
            'N' => 'Communication network unreachable',
            'O' => 'Communication out of service',
            'P' => 'Communication protocol error',
            'Q' => 'Communication queue overflow',
            'R' => 'Communication reset required',
            'S' => 'Communication signal lost',
            'T' => 'Communication timeout',
            'U' => 'Communication unknown error',
            'V' => 'Communication validation failed',
            'W' => 'Communication warning',
            'X' => 'Communication external error',
            'Y' => 'Communication synchronization error',
            'Z' => 'Communication zone failure'
        ];
    }

    /**
     * Get extended bill validator event codes (EJ + letter) - Table 10: BILL VALIDATORS
     * 
     * @return array Bill validator event codes
     */
    public static function getBillValidatorEvents(): array
    {
        return [
            'A' => 'Bill validator active',
            'B' => 'Bill validator busy',
            'C' => 'Bill validator cash box full',
            'D' => 'Bill validator disabled',
            'E' => 'Bill validator enabled',
            'F' => 'Bill validator fault',
            'G' => 'Bill validator general error',
            'H' => 'Bill validator hopper full',
            'I' => 'Bill validator inhibited',
            'J' => 'Bill validator jam detected',
            'K' => 'Bill validator key missing',
            'L' => 'Bill validator low denomination',
            'M' => 'Bill validator maintenance required',
            'N' => 'Bill validator not ready',
            'O' => 'Bill validator out of service',
            'P' => 'Bill validator payment successful',
            'Q' => 'Bill validator queue full',
            'R' => 'Bill validator reset',
            'S' => 'Bill validator service mode',
            'T' => 'Bill validator timeout',
            'U' => 'Bill validator unspecified error',
            'V' => 'Bill validator validation error',
            'W' => 'Bill validator warning',
            'X' => 'Fault was induced by a client due to vandalism or fraud',
            'Y' => 'Bill validator yield problem',
            'Z' => 'Bill validator zone error'
        ];
    }

    /**
     * Get extended cashless payment event codes (EK + letter) - Table 11: CASHLESS PAYMENTS
     * 
     * @return array Cashless payment event codes
     */
    public static function getCashlessPaymentEvents(): array
    {
        return [
            'A' => 'Cashless payment authorized',
            'B' => 'Cashless payment busy',
            'C' => 'Cashless payment cancelled',
            'D' => 'Cashless payment declined',
            'E' => 'Cashless payment error',
            'F' => 'Cashless payment failed',
            'G' => 'Cashless payment general fault',
            'H' => 'Cashless payment hold',
            'I' => 'Cashless payment insufficient funds',
            'J' => 'Cashless payment jam',
            'K' => 'Cashless payment key error',
            'L' => 'Cashless payment limit exceeded',
            'M' => 'Cashless payment maintenance mode',
            'N' => 'Cashless payment network error',
            'O' => 'Cashless payment offline',
            'P' => 'Cashless payment processed',
            'Q' => 'Cashless payment queued',
            'R' => 'Cashless payment refund',
            'S' => 'Cashless payment successful',
            'T' => 'Cashless payment timeout',
            'U' => 'Cashless payment unauthorized',
            'V' => 'Cashless payment void',
            'W' => 'Cashless payment warning',
            'X' => 'Cashless payment external error',
            'Y' => 'Cashless payment system error',
            'Z' => 'Cashless payment zone fault'
        ];
    }

    /**
     * Get extended temperature control event codes (EL + letter) - Table 12: TEMPERATURE CONTROL
     * 
     * @return array Temperature control event codes
     */
    public static function getTemperatureControlEvents(): array
    {
        return [
            'A' => 'Temperature control active',
            'B' => 'Temperature control below threshold',
            'C' => 'Temperature control cooling started',
            'D' => 'Temperature control defrost mode',
            'E' => 'Temperature control error',
            'F' => 'Temperature control fan failure',
            'G' => 'Temperature control general fault',
            'H' => 'Temperature control heating started',
            'I' => 'Temperature control idle',
            'J' => 'Temperature control jam protection',
            'K' => 'Temperature control key switch',
            'L' => 'Temperature control low temperature',
            'M' => 'Temperature control maintenance mode',
            'N' => 'Temperature control normal operation',
            'O' => 'Temperature control overheating',
            'P' => 'Temperature control power failure',
            'Q' => 'Temperature control quality check',
            'R' => 'Temperature control reset',
            'S' => 'Temperature control sensor fault',
            'T' => 'Temperature control threshold reached',
            'U' => 'Temperature control unstable',
            'V' => 'Temperature control ventilation error',
            'W' => 'Temperature control warning',
            'X' => 'Temperature control external fault',
            'Y' => 'Temperature control system failure',
            'Z' => 'Temperature control zone alarm'
        ];
    }

    /**
     * Get extended refrigeration event codes (EO + letter) - System: Refrigeration System faults
     * Based on actual EVA-DTS specification tables
     * 
     * @return array Refrigeration event codes
     */
    /**
     * Get extended refrigeration event codes (EO + letter) - System: Refrigeration System faults
     * Based on actual EVA-DTS specification tables
     * 
     * @return array Refrigeration event codes
     */
    public static function getRefrigerationEvents(): array
    {
        return [
            '' => 'General non-specific Refrigeration System fault.',
            'A' => 'Failed sensor or incorrect reading',
            'B' => 'Defective relay or triac causing compressor to run continously or not start',
            'C' => 'Errors include: leaks, doesn\'t run, reduced capacity or tripping due to overload',
            'D' => 'Defective or stuck current relay or PTC',
            'E' => 'Failed trip mechanism',
            'F' => 'Failed capacitor, compresssor won\'t start',
            'G' => 'Internal restriction or kinked tube',
            'H' => 'Has leaks or air is restricted because of dirt/debries',
            'I' => 'Bent fan blade or fan motor failure',
            'J' => 'Has leaks or air is restricted because of dirt/debries or frozen',
            'K' => 'Evaporator fan motor failure',
            'L' => 'Failed expansion value',
            'M' => 'Refrigerant is leaking',
            'N' => 'Defective relay or triac',
            'O' => 'Defective switch',
            'P' => 'Defective Heaters',
            'Q' => 'Defective condensate pan or evaporator pan, or restricted drain tube',
            'V' => 'Modifications have been made.',
            'W' => 'No fault was found',
            'X' => 'Fault occurred caused by client.',
            'Y' => 'Fault occurred caused by service technician.',
            'Z' => 'Fault has occurred which is not listed above.'
        ];
    }

    /**
     * Get extended heating system event codes (EN + letter) - Table 14: HEATING SYSTEMS
     * 
     * @return array Heating system event codes
     */
    public static function getHeatingSystemEvents(): array
    {
        return [
            'A' => 'Heating system active',
            'B' => 'Heating system blocked',
            'C' => 'Heating system control fault',
            'D' => 'Heating system disabled',
            'E' => 'Heating system element fault',
            'F' => 'Heating system failure',
            'G' => 'Heating system gas fault',
            'H' => 'Heating system high temperature',
            'I' => 'Heating system inactive',
            'J' => 'Heating system jam',
            'K' => 'Heating system key fault',
            'L' => 'Heating system low temperature',
            'M' => 'Heating system maintenance mode',
            'N' => 'Heating system normal operation',
            'O' => 'Heating system overheating',
            'P' => 'Heating system power fault',
            'Q' => 'Heating system quality check',
            'R' => 'Heating system reset',
            'S' => 'Heating system safety shutdown',
            'T' => 'Heating system thermostat fault',
            'U' => 'Heating system unstable',
            'V' => 'Heating system ventilation fault',
            'W' => 'Heating system warning',
            'X' => 'Heating system external fault',
            'Y' => 'Heating system yield problem',
            'Z' => 'Heating system zone fault'
        ];
    }

    /**
     * Get extended motor control event codes (EO + letter) - Table 15: MOTOR CONTROL
     * 
     * @return array Motor control event codes
     */
    public static function getMotorControlEvents(): array
    {
        return [
            'A' => 'Motor control active',
            'B' => 'Motor control blocked',
            'C' => 'Motor control current fault',
            'D' => 'Motor control disabled',
            'E' => 'Motor control encoder fault',
            'F' => 'Motor control failure',
            'G' => 'Motor control gear fault',
            'H' => 'Motor control heating fault',
            'I' => 'Motor control inactive',
            'J' => 'Motor control jam detected',
            'K' => 'Motor control key fault',
            'L' => 'Motor control limit switch fault',
            'M' => 'Motor control maintenance required',
            'N' => 'Motor control normal operation',
            'O' => 'Motor control overload',
            'P' => 'Motor control position fault',
            'Q' => 'Motor control quality check failed',
            'R' => 'Motor control reset',
            'S' => 'Motor control stalled',
            'T' => 'Motor control timeout',
            'U' => 'Motor control unstable',
            'V' => 'Motor control voltage fault',
            'W' => 'Motor control warning',
            'X' => 'Motor control external fault',
            'Y' => 'Motor control yield fault',
            'Z' => 'Motor control zone error'
        ];
    }

    /**
     * Get extended sensor system event codes (EP + letter) - Table 16: SENSOR SYSTEMS
     * 
     * @return array Sensor system event codes
     */
    public static function getSensorSystemEvents(): array
    {
        return [
            'A' => 'Sensor system active',
            'B' => 'Sensor system blocked',
            'C' => 'Sensor system calibration required',
            'D' => 'Sensor system disconnected',
            'E' => 'Sensor system error',
            'F' => 'Sensor system fault',
            'G' => 'Sensor system general fault',
            'H' => 'Sensor system high reading',
            'I' => 'Sensor system inactive',
            'J' => 'Sensor system jam detected',
            'K' => 'Sensor system key fault',
            'L' => 'Sensor system low reading',
            'M' => 'Sensor system maintenance required',
            'N' => 'Sensor system normal operation',
            'O' => 'Sensor system out of range',
            'P' => 'Sensor system power fault',
            'Q' => 'Sensor system quality check failed',
            'R' => 'Sensor system reset',
            'S' => 'Sensor system signal lost',
            'T' => 'Sensor system threshold exceeded',
            'U' => 'Sensor system unstable reading',
            'V' => 'Sensor system validation failed',
            'W' => 'Sensor system warning',
            'X' => 'Sensor system external interference',
            'Y' => 'Sensor system yield problem',
            'Z' => 'Sensor system zone fault'
        ];
    }

    /**
     * Get extended security system event codes (EQ + letter) - Table 17: SECURITY SYSTEMS
     * 
     * @return array Security system event codes
     */
    public static function getSecuritySystemEvents(): array
    {
        return [
            'A' => 'Security system armed',
            'B' => 'Security system breach detected',
            'C' => 'Security system camera fault',
            'D' => 'Security system disarmed',
            'E' => 'Security system emergency stop',
            'F' => 'Security system fault',
            'G' => 'Security system general alarm',
            'H' => 'Security system hold up alarm',
            'I' => 'Security system intrusion detected',
            'J' => 'Security system jam detected',
            'K' => 'Security system key fault',
            'L' => 'Security system lock fault',
            'M' => 'Security system maintenance mode',
            'N' => 'Security system normal operation',
            'O' => 'Security system override',
            'P' => 'Security system panic alarm',
            'Q' => 'Security system quality check failed',
            'R' => 'Security system reset',
            'S' => 'Security system silent alarm',
            'T' => 'Security system tamper detected',
            'U' => 'Security system unauthorized access',
            'V' => 'Security system vandalism detected',
            'W' => 'Security system warning',
            'X' => 'Security system external alarm',
            'Y' => 'Security system system failure',
            'Z' => 'Security system zone alarm'
        ];
    }

    /**
     * Get extended display system event codes (ER + letter) - Table 18: DISPLAY SYSTEMS
     * 
     * @return array Display system event codes
     */
    public static function getDisplaySystemEvents(): array
    {
        return [
            'A' => 'Display system active',
            'B' => 'Display system brightness fault',
            'C' => 'Display system contrast fault',
            'D' => 'Display system disabled',
            'E' => 'Display system error',
            'F' => 'Display system failure',
            'G' => 'Display system graphics fault',
            'H' => 'Display system hardware fault',
            'I' => 'Display system inactive',
            'J' => 'Display system jam protection',
            'K' => 'Display system key fault',
            'L' => 'Display system LED fault',
            'M' => 'Display system maintenance mode',
            'N' => 'Display system normal operation',
            'O' => 'Display system offline',
            'P' => 'Display system power fault',
            'Q' => 'Display system quality check failed',
            'R' => 'Display system reset',
            'S' => 'Display system screen fault',
            'T' => 'Display system timeout',
            'U' => 'Display system update fault',
            'V' => 'Display system video fault',
            'W' => 'Display system warning',
            'X' => 'Display system external fault',
            'Y' => 'Display system yield problem',
            'Z' => 'Display system zone fault'
        ];
    }

    /**
     * Get extended audio system event codes (ES + letter) - Table 19: AUDIO SYSTEMS
     * 
     * @return array Audio system event codes
     */
    public static function getAudioSystemEvents(): array
    {
        return [
            'A' => 'Audio system active',
            'B' => 'Audio system busy',
            'C' => 'Audio system channel fault',
            'D' => 'Audio system disabled',
            'E' => 'Audio system error',
            'F' => 'Audio system failure',
            'G' => 'Audio system general fault',
            'H' => 'Audio system hardware fault',
            'I' => 'Audio system inactive',
            'J' => 'Audio system jack fault',
            'K' => 'Audio system key fault',
            'L' => 'Audio system low volume',
            'M' => 'Audio system mute activated',
            'N' => 'Audio system normal operation',
            'O' => 'Audio system output fault',
            'P' => 'Audio system power fault',
            'Q' => 'Audio system quality check failed',
            'R' => 'Audio system reset',
            'S' => 'Audio system speaker fault',
            'T' => 'Audio system timeout',
            'U' => 'Audio system unstable',
            'V' => 'Audio system volume fault',
            'W' => 'Audio system warning',
            'X' => 'Audio system external fault',
            'Y' => 'Audio system yield problem',
            'Z' => 'Audio system zone fault'
        ];
    }

    /**
     * Get extended network system event codes (ET + letter) - Table 20: NETWORK SYSTEMS
     * 
     * @return array Network system event codes
     */
    public static function getNetworkSystemEvents(): array
    {
        return [
            'A' => 'Network system active',
            'B' => 'Network system bandwidth exceeded',
            'C' => 'Network system connection lost',
            'D' => 'Network system disconnected',
            'E' => 'Network system error',
            'F' => 'Network system failure',
            'G' => 'Network system gateway fault',
            'H' => 'Network system hardware fault',
            'I' => 'Network system IP conflict',
            'J' => 'Network system jam in traffic',
            'K' => 'Network system key exchange failed',
            'L' => 'Network system link down',
            'M' => 'Network system maintenance mode',
            'N' => 'Network system normal operation',
            'O' => 'Network system offline',
            'P' => 'Network system protocol error',
            'Q' => 'Network system quality degraded',
            'R' => 'Network system reset',
            'S' => 'Network system signal weak',
            'T' => 'Network system timeout',
            'U' => 'Network system unauthorized access',
            'V' => 'Network system VPN fault',
            'W' => 'Network system warning',
            'X' => 'Network system external fault',
            'Y' => 'Network system yield problem',
            'Z' => 'Network system zone unreachable'
        ];
    }

    /**
     * Get operations request event codes (OA + letter/number) - Operations Request faults
     * Based on actual EVA-DTS specification tables
     * 
     * @return array Operations request event codes
     */
    public static function getOperationsRequestEvents(): array
    {
        return [
            '' => 'General non-specific Operations Request fault.',
            'A' => 'Maintenance services (some specific services are listed below)',
            'B' => 'Inspecting and checking Product / Function / Service',
            'C' => 'Delivery to the customer',
            'D' => 'Delivery and installation at the customer site',
            'E' => 'Installation at the customer site',
            'F' => 'Replace a machine at the customer by another machine',
            'G' => 'Collect from the customer site',
            'H' => 'Move the machine from one place at the customer to another',
            'I' => 'Training of operations staff',
            'J' => 'Sanitizing the vending machine',
            'K' => 'Water filter change',
            'L' => 'If required specify product No.(x): OAL_x',
            'M' => 'If required specify product No.(x): OAM_x',
            'N' => 'Check ingredience quantity according the recipe',
            'O' => 'Replace used bottle by full bottle',
            'P' => 'Action required due to any kind of loss',
            'Q' => 'Brewer de-greasing',
            'R' => 'For higyene purpose',
            'S' => 'Reporting to country specific or local authorities',
            'T' => 'If required specify product No.(x): OAT_x',
            'U' => 'If required specify product No.(x): OAU_x',
            '1A' => 'If required specify product No.(x): OA1A_x',
            '1B' => 'All Products are filled to the required restock level',
            '1C' => 'Specific Product is filled to the required restock level. Specify product No.(x): OA1C_x',
            'V' => '',
            'W' => '',
            'X' => '',
            'Y' => '',
            'Z' => ''
        ];
    }

    /**
     * Get service related event codes (OB + letter) - Service Related faults
     * Based on actual EVA-DTS specification tables
     * 
     * @return array Service related event codes
     */
    public static function getServiceRelatedEvents(): array
    {
        return [
            '' => 'General non-specific Service Related fault.',
            'A' => 'Wrong product, place, quantity,spiral position, …',
            'B' => 'Left open by mistake',
            'C' => 'Quantity not sufficient until next regular visit (estimation). If required specify product No.(x): OBC_x',
            'D' => 'Quantity not sufficient until next regular visit (estimation).',
            'E' => 'Packaging, quality, ingredients, additives, out of date, temperature, etc.',
            'F' => 'Broken, blocked, wrong size, wrong type',
            'G' => 'Quantity not sufficient until next regular visit (estimation).',
            'H' => 'Waste bucket not in correct position or necessary to empty',
            'I' => 'Waste water pipe not in correct position',
            'J' => 'If required specify product No.(x): OBJ_x',
            'K' => 'Changegiver',
            'L' => 'Wrong position, bad positioned, not or not properly connected',
            'M' => 'Induced by customer, consumer, operator',
            'N' => 'If required specify product No.(x): OBN_x',
            'O' => 'Coins and/or bills and/or tokens',
            'P' => 'Low, wrong or no coin and/or tokens acceptance',
            'Q' => 'If required specify product No.(x): OBQ_x',
            'R' => 'Low, wrong or no bill acceptance',
            'S' => 'Cashless device refuses value carriers unexpectedly',
            'T' => 'Insufficient cooling: Temperature of cold drinks and/or (liquid) ingredients and/or food is too high (or eventually too low)',
            'V' => '',
            'W' => '',
            'X' => '',
            'Y' => '',
            'Z' => ''
        ];
    }

    /**
     * Get customer induced event codes (OC + letter) - Customer Induced faults
     * Based on actual EVA-DTS specification tables
     * 
     * @return array Customer induced event codes
     */
    public static function getCustomerInducedEvents(): array
    {
        return [
            '' => 'General non-specific Customer Induced fault.',
            'A' => 'Machine forced, cash box, money or products stolen',
            'B' => 'Parts broken, spilled, destroied, grafity,etc. done on purpose…',
            'C' => 'Slot coinmech blocked (chewing gum, self made coins, dirt, …)',
            'D' => 'Soup, coffee or other liquid products are spilled in the vending machine',
            'E' => 'Slot bill reader blocked (cards, paper, …)',
            'F' => 'Machine out of order due to power failure',
            'G' => 'Products prepared with water are not available',
            'H' => 'Consumer, operator or technician has no or insufficient access to vending machine',
            'I' => 'Multiplying money (fraud) in order to get products for free or a lower price, …',
            'J' => 'No access to customer database (central credit or debit), server shut down, …',
            'K' => 'No communication between operator\'s communication tool and vending machine',
            'L' => 'Identification media or value carrier are not or wrong programmed',
            'M' => 'Vending machine not ready to sale due to system operating failure',
            'N' => 'Vending machine not ready to sale due to system configuring failure',
            'Z' => ''
        ];
    }

    /**
     * Get return visits event codes (OD + letter) - Return Visits faults
     * Based on actual EVA-DTS specification tables
     * 
     * @return array Return visits event codes
     */
    public static function getReturnVisitsEvents(): array
    {
        return [
            '' => 'General non-specific Return Visits fault.',
            'A' => 'If required specify part x: ODA_x',
            'B' => '',
            'C' => '',
            'D' => 'If required specify repair job (x): ODD_x',
            'E' => 'If required specify public relations job (x): ODE_x',
            'F' => 'If required specify previous work (x): ODF_x',
            'Z' => ''
        ];
    }

    /**
     * Get machine history event codes (OE + letter) - Machine History faults
     * Based on actual EVA-DTS specification tables
     * 
     * @return array Machine history event codes
     */
    public static function getMachineHistoryEvents(): array
    {
        return [
            '' => 'General non-specific Machine History fault.',
            'A' => 'Event detection outside office hours of the service/operating company',
            'B' => 'Coin configuration change giver',
            'Z' => ''
        ];
    }

    /**
     * Get cash collection event codes (OF + letter) - Cash Collection faults
     * Based on actual EVA-DTS specification tables
     * 
     * @return array Cash collection event codes
     */
    public static function getCashCollectionEvents(): array
    {
        return [
            '' => 'General non-specific Cash Collection fault.',
            'A' => 'Coin and/or token box emptied',
            'B' => 'Bill box / stacker emptied',
            'C' => 'Audit data delivered to clearing center (electronic purse, mobile payment)',
            'D' => 'Tubes emptied'
        ];
    }

    /**
     * Get legacy text-based event descriptions
     * 
     * @return array Legacy event descriptions
     */
    public static function getLegacyEvents(): array
    {
        return [
            'DEB' => 'Debug information',
            'PTV' => 'Product test vend operation',
            'PVD' => 'Product vend dispensed successfully',
            'PVE' => 'Product vend error occurred',
            'RESET' => 'System reset operation',
            'KONF' => 'Configuration change'
        ];
    }

    /**
     * Categorize event type based on event ID
     * 
     * @param string $eventId Event ID
     * @return string Event category
     */
    public static function categorizeEvent(string $eventId): string
    {
        $eventId = trim($eventId);
        $predefinedEvents = self::getPredefinedEvents();
        
        // Check if it's a predefined hex event code
        if (isset($predefinedEvents[$eventId])) {
            return $predefinedEvents[$eventId]['category'];
        }
        
        // Extended event series categorization
        if (strpos($eventId, 'EA') === 0) return 'coin';
        if (strpos($eventId, 'EB') === 0) return 'cup';
        if (strpos($eventId, 'EC') === 0) return 'control';
        if (strpos($eventId, 'EG') === 0) return 'cabinet';
        if (strpos($eventId, 'EI') === 0) return 'communication';
        if (strpos($eventId, 'EJ') === 0) return 'bill_validator';
        if (strpos($eventId, 'EK') === 0) return 'cashless_payment';
        if (strpos($eventId, 'EL') === 0) return 'temperature_control';
        if (strpos($eventId, 'EM') === 0) return 'refrigeration';
        if (strpos($eventId, 'EN') === 0) return 'heating_system';
        if (strpos($eventId, 'EO') === 0) return 'refrigeration'; // EO is refrigeration according to user's tables
        if (strpos($eventId, 'EP') === 0) return 'sensor_system';
        if (strpos($eventId, 'EQ') === 0) return 'security_system';
        if (strpos($eventId, 'ER') === 0) return 'display_system';
        if (strpos($eventId, 'ES') === 0) return 'audio_system';
        if (strpos($eventId, 'ET') === 0) return 'network_system';
        if (strpos($eventId, 'OA') === 0) return 'operations_request';
        if (strpos($eventId, 'OB') === 0) return 'service_related';
        if (strpos($eventId, 'OC') === 0) return 'customer_induced';
        if (strpos($eventId, 'OD') === 0) return 'return_visits';
        if (strpos($eventId, 'OE') === 0) return 'machine_history';
        if (strpos($eventId, 'OF') === 0) return 'cash_collection';
        if (strpos($eventId, 'DEB') === 0) return 'debug';
        if (strpos($eventId, 'PTV') === 0) return 'product_test';
        if (strpos($eventId, 'PVD') === 0) return 'product_vend';
        if (strpos($eventId, 'PVE') === 0) return 'product_error';
        
        return 'system';
    }

    /**
     * Get event severity level based on event ID
     * 
     * @param string $eventId Event ID
     * @return string Severity level
     */
    public static function getEventSeverity(string $eventId): string
    {
        $eventId = trim($eventId);
        $predefinedEvents = self::getPredefinedEvents();
        
        // Check if it's a predefined hex event code
        if (isset($predefinedEvents[$eventId])) {
            return $predefinedEvents[$eventId]['severity'];
        }
        
        // Extended severity mapping for all E-series events
        if (preg_match('/^(EA|EB|EC|EG|EI|EJ|EK|EL|EM|EN|EO|EP|EQ|ER|ES|ET)[A-Z]$/', $eventId)) {
            $eventCode = $eventId[2];
            
            // Critical/Error events
            if (in_array($eventCode, ['A', 'F', 'G', 'J', 'M', 'O', 'U', 'V', 'X', 'Y', 'Z'])) {
                return 'error';
            }
            
            // Warning events  
            if (in_array($eventCode, ['B', 'C', 'D', 'H', 'I', 'K', 'L', 'N', 'Q', 'S', 'T', 'W'])) {
                return 'warning';
            }
            
            // Info events (normal operations)
            return 'info';
        }
        
        // Extended severity mapping for O-series events (Operations, Service, Customer, etc.)
        if (preg_match('/^(OA|OB|OC|OD|OE|OF)/', $eventId)) {
            // Customer induced events are typically more serious
            if (strpos($eventId, 'OC') === 0) {
                return 'warning'; // Vandalism, theft, etc.
            }
            
            // Service related issues are warnings
            if (strpos($eventId, 'OB') === 0) {
                return 'warning';
            }
            
            // Operations requests are typically informational
            if (strpos($eventId, 'OA') === 0) {
                return 'info';
            }
            
            // Return visits, machine history, cash collection are informational
            return 'info';
        }
        
        // Legacy text-based severity determination
        if (strpos($eventId, 'ERROR') !== false) return 'error';
        if (strpos($eventId, 'WARN') !== false) return 'warning';
        if (strpos($eventId, 'DEB') === 0) return 'debug';
        if (strpos($eventId, 'PVE') === 0) return 'error';
        
        return 'info';
    }

    /**
     * Get event description based on event ID
     * 
     * @param string $eventId Event ID
     * @return string Event description
     */
    public static function getEventDescription(string $eventId): string
    {
        $eventId = trim($eventId);
        $predefinedEvents = self::getPredefinedEvents();
        
        // Check if it's a predefined hex event code
        if (isset($predefinedEvents[$eventId])) {
            return $predefinedEvents[$eventId]['description'];
        }
        
        // Extended coin acceptor event codes (EA + letter)
        if (strpos($eventId, 'EA') === 0 && strlen($eventId) === 3) {
            $coinEvents = self::getCoinEvents();
            $coinEventCode = $eventId[2];
            
            if (isset($coinEvents[$coinEventCode])) {
                return $coinEvents[$coinEventCode];
            }
            
            return "Coin acceptor event: $coinEventCode";
        }
        
        // Extended cup dispenser event codes (EB + letter)
        if (strpos($eventId, 'EB') === 0 && strlen($eventId) === 3) {
            $cupEvents = self::getCupEvents();
            $cupEventCode = $eventId[2];
            
            if (isset($cupEvents[$cupEventCode])) {
                return $cupEvents[$cupEventCode];
            }
            
            return "Cup dispenser event: $cupEventCode";
        }
        
        // Extended control board event codes (EC + letter)
        if (strpos($eventId, 'EC') === 0 && strlen($eventId) === 3) {
            $controlEvents = self::getControlEvents();
            $controlEventCode = $eventId[2];
            
            if (isset($controlEvents[$controlEventCode])) {
                return $controlEvents[$controlEventCode];
            }
            
            return "Control board event: $controlEventCode";
        }
        
        // Extended cabinet event codes (EG + letter)  
        if (strpos($eventId, 'EG') === 0 && strlen($eventId) === 3) {
            $cabinetEvents = self::getCabinetEvents();
            $cabinetEventCode = $eventId[2];
            
            if (isset($cabinetEvents[$cabinetEventCode])) {
                return $cabinetEvents[$cabinetEventCode];
            }
            
            return "Cabinet event: $cabinetEventCode";
        }
        
        // Extended communication event codes (EI + letter) - Table 9: COMMUNICATIONS
        if (strpos($eventId, 'EI') === 0 && strlen($eventId) === 3) {
            $commEvents = self::getCommunicationEvents();
            $commEventCode = $eventId[2];
            
            if (isset($commEvents[$commEventCode])) {
                return $commEvents[$commEventCode];
            }
            
            return "Communication event: $commEventCode";
        }
        
        // Extended bill validator event codes (EJ + letter) - Table 10: BILL VALIDATORS
        if (strpos($eventId, 'EJ') === 0 && strlen($eventId) === 3) {
            $billEvents = self::getBillValidatorEvents();
            $billEventCode = $eventId[2];
            
            if (isset($billEvents[$billEventCode])) {
                return $billEvents[$billEventCode];
            }
            
            return "Bill validator event: $billEventCode";
        }
        
        // Extended cashless payment event codes (EK + letter) - Table 11: CASHLESS PAYMENTS
        if (strpos($eventId, 'EK') === 0 && strlen($eventId) === 3) {
            $cashlessEvents = self::getCashlessPaymentEvents();
            $cashlessEventCode = $eventId[2];
            
            if (isset($cashlessEvents[$cashlessEventCode])) {
                return $cashlessEvents[$cashlessEventCode];
            }
            
            return "Cashless payment event: $cashlessEventCode";
        }
        
        // Extended temperature control event codes (EL + letter) - Table 12: TEMPERATURE CONTROL
        if (strpos($eventId, 'EL') === 0 && strlen($eventId) === 3) {
            $tempEvents = self::getTemperatureControlEvents();
            $tempEventCode = $eventId[2];
            
            if (isset($tempEvents[$tempEventCode])) {
                return $tempEvents[$tempEventCode];
            }
            
            return "Temperature control event: $tempEventCode";
        }
        
        // Extended refrigeration event codes (EM + letter) - Table 13: REFRIGERATION
        if (strpos($eventId, 'EM') === 0 && strlen($eventId) === 3) {
            $refrigEvents = self::getRefrigerationEvents();
            $refrigEventCode = $eventId[2];
            
            if (isset($refrigEvents[$refrigEventCode])) {
                return $refrigEvents[$refrigEventCode];
            }
            
            return "Refrigeration event: $refrigEventCode";
        }
        
        // Extended heating system event codes (EN + letter) - Table 14: HEATING SYSTEMS
        if (strpos($eventId, 'EN') === 0 && strlen($eventId) === 3) {
            $heatingEvents = self::getHeatingSystemEvents();
            $heatingEventCode = $eventId[2];
            
            if (isset($heatingEvents[$heatingEventCode])) {
                return $heatingEvents[$heatingEventCode];
            }
            
            return "Heating system event: $heatingEventCode";
        }
        
        // Extended refrigeration system event codes (EO + letter) - System: Refrigeration System faults
        if (strpos($eventId, 'EO') === 0) {
            $refrigEvents = self::getRefrigerationEvents();
            
            // Handle EO without suffix (general refrigeration fault)
            if ($eventId === 'EO') {
                return $refrigEvents[''] ?? 'General non-specific Refrigeration System fault.';
            }
            
            // Handle EO + letter
            if (strlen($eventId) === 3) {
                $refrigEventCode = $eventId[2];
                
                if (isset($refrigEvents[$refrigEventCode])) {
                    return $refrigEvents[$refrigEventCode];
                }
                
                return "Refrigeration system event: $refrigEventCode";
            }
        }
        
        // Extended sensor system event codes (EP + letter) - Table 16: SENSOR SYSTEMS
        if (strpos($eventId, 'EP') === 0 && strlen($eventId) === 3) {
            $sensorEvents = self::getSensorSystemEvents();
            $sensorEventCode = $eventId[2];
            
            if (isset($sensorEvents[$sensorEventCode])) {
                return $sensorEvents[$sensorEventCode];
            }
            
            return "Sensor system event: $sensorEventCode";
        }
        
        // Extended security system event codes (EQ + letter) - Table 17: SECURITY SYSTEMS
        if (strpos($eventId, 'EQ') === 0 && strlen($eventId) === 3) {
            $securityEvents = self::getSecuritySystemEvents();
            $securityEventCode = $eventId[2];
            
            if (isset($securityEvents[$securityEventCode])) {
                return $securityEvents[$securityEventCode];
            }
            
            return "Security system event: $securityEventCode";
        }
        
        // Extended display system event codes (ER + letter) - Table 18: DISPLAY SYSTEMS
        if (strpos($eventId, 'ER') === 0 && strlen($eventId) === 3) {
            $displayEvents = self::getDisplaySystemEvents();
            $displayEventCode = $eventId[2];
            
            if (isset($displayEvents[$displayEventCode])) {
                return $displayEvents[$displayEventCode];
            }
            
            return "Display system event: $displayEventCode";
        }
        
        // Extended audio system event codes (ES + letter) - Table 19: AUDIO SYSTEMS
        if (strpos($eventId, 'ES') === 0 && strlen($eventId) === 3) {
            $audioEvents = self::getAudioSystemEvents();
            $audioEventCode = $eventId[2];
            
            if (isset($audioEvents[$audioEventCode])) {
                return $audioEvents[$audioEventCode];
            }
            
            return "Audio system event: $audioEventCode";
        }
        
        // Extended network system event codes (ET + letter) - Table 20: NETWORK SYSTEMS
        if (strpos($eventId, 'ET') === 0 && strlen($eventId) === 3) {
            $networkEvents = self::getNetworkSystemEvents();
            $networkEventCode = $eventId[2];
            
            if (isset($networkEvents[$networkEventCode])) {
                return $networkEvents[$networkEventCode];
            }
            
            return "Network system event: $networkEventCode";
        }
        
        // Operations Request event codes (OA + letter/number)
        if (strpos($eventId, 'OA') === 0) {
            $operationsEvents = self::getOperationsRequestEvents();
            
            // Handle OA without suffix (general operations request fault)
            if ($eventId === 'OA') {
                return $operationsEvents[''] ?? 'General non-specific Operations Request fault.';
            }
            
            // Handle OA + letter/number (support multi-character codes like "1A")
            $operationsEventCode = substr($eventId, 2);
            
            if (isset($operationsEvents[$operationsEventCode])) {
                return $operationsEvents[$operationsEventCode];
            }
            
            return "Operations request event: $operationsEventCode";
        }
        
        // Service Related event codes (OB + letter)
        if (strpos($eventId, 'OB') === 0) {
            $serviceEvents = self::getServiceRelatedEvents();
            
            // Handle OB without suffix (general service related fault)
            if ($eventId === 'OB') {
                return $serviceEvents[''] ?? 'General non-specific Service Related fault.';
            }
            
            // Handle OB + letter
            if (strlen($eventId) === 3) {
                $serviceEventCode = $eventId[2];
                
                if (isset($serviceEvents[$serviceEventCode])) {
                    return $serviceEvents[$serviceEventCode];
                }
                
                return "Service related event: $serviceEventCode";
            }
        }
        
        // Customer Induced event codes (OC + letter)
        if (strpos($eventId, 'OC') === 0) {
            $customerEvents = self::getCustomerInducedEvents();
            
            // Handle OC without suffix (general customer induced fault)
            if ($eventId === 'OC') {
                return $customerEvents[''] ?? 'General non-specific Customer Induced fault.';
            }
            
            // Handle OC + letter
            if (strlen($eventId) === 3) {
                $customerEventCode = $eventId[2];
                
                if (isset($customerEvents[$customerEventCode])) {
                    return $customerEvents[$customerEventCode];
                }
                
                return "Customer induced event: $customerEventCode";
            }
        }
        
        // Return Visits event codes (OD + letter)
        if (strpos($eventId, 'OD') === 0) {
            $returnVisitsEvents = self::getReturnVisitsEvents();
            
            // Handle OD without suffix (general return visits fault)
            if ($eventId === 'OD') {
                return $returnVisitsEvents[''] ?? 'General non-specific Return Visits fault.';
            }
            
            // Handle OD + letter
            if (strlen($eventId) === 3) {
                $returnVisitsEventCode = $eventId[2];
                
                if (isset($returnVisitsEvents[$returnVisitsEventCode])) {
                    return $returnVisitsEvents[$returnVisitsEventCode];
                }
                
                return "Return visits event: $returnVisitsEventCode";
            }
        }
        
        // Machine History event codes (OE + letter)
        if (strpos($eventId, 'OE') === 0) {
            $machineHistoryEvents = self::getMachineHistoryEvents();
            
            // Handle OE without suffix (general machine history fault)
            if ($eventId === 'OE') {
                return $machineHistoryEvents[''] ?? 'General non-specific Machine History fault.';
            }
            
            // Handle OE + letter
            if (strlen($eventId) === 3) {
                $machineHistoryEventCode = $eventId[2];
                
                if (isset($machineHistoryEvents[$machineHistoryEventCode])) {
                    return $machineHistoryEvents[$machineHistoryEventCode];
                }
                
                return "Machine history event: $machineHistoryEventCode";
            }
        }
        
        // Cash Collection event codes (OF + letter)
        if (strpos($eventId, 'OF') === 0) {
            $cashCollectionEvents = self::getCashCollectionEvents();
            
            // Handle OF without suffix (general cash collection fault)
            if ($eventId === 'OF') {
                return $cashCollectionEvents[''] ?? 'General non-specific Cash Collection fault.';
            }
            
            // Handle OF + letter
            if (strlen($eventId) === 3) {
                $cashCollectionEventCode = $eventId[2];
                
                if (isset($cashCollectionEvents[$cashCollectionEventCode])) {
                    return $cashCollectionEvents[$cashCollectionEventCode];
                }
                
                return "Cash collection event: $cashCollectionEventCode";
            }
        }
        
        // Legacy text-based descriptions
        $legacyEvents = self::getLegacyEvents();
        
        return $legacyEvents[$eventId] ?? "Event: $eventId";
    }
}
