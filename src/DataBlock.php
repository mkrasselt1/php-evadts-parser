<?php

namespace PeanutPay\PhpEvaDts;

/**
 * Base DataBlock class for EVA DTS data parsing
 * 
 * This class serves as the foundation for all EVA DTS data block types.
 * It provides parsing functionality and a factory method for creating
 * specific data block instances based on the EVA DTS command type.
 * 
 * @package PeanutPay\PhpEvaDts
 * @author Michael Krasselt <michael@peanutpay.de>
 */
class DataBlock implements DataBlockInterface
{
    /** @var string Empty constant for unused fields */
    const NONE = "";
    
    /** @var array Field assignment mapping for this data block type */
    const ASSIGNMENT = [];
    
    /**
     * Creates a new DataBlock instance
     * 
     * @param string $msg EVA DTS message string to be parsed
     * 
     * @example
     * ```php
     * $block = new DataBlock("PA1*1*Coffee*100*1");
     * ```
     */
    public function __construct($msg = "")
    {
        if (!empty($msg)) {
            $this->parse($msg);
        }
    }

    /**
     * Factory method to create specific DataBlock instances
     * 
     * Analyzes the EVA DTS command type and returns the appropriate
     * data block class instance for parsing the data.
     * 
     * @param string $dataString Raw EVA DTS data string
     * @return DataBlockInterface|null The appropriate data block instance or null if unknown
     * 
     * @example
     * ```php
     * $block = DataBlock::create("PA1*1*Coffee*100*1");
     * if ($block instanceof ProductDataBlock) {
     *     echo "Product: " . $block->name;
     * }
     * ```
     */
    public static function create($dataString): ?DataBlockInterface
    {
        $dataArray = \explode("*", $dataString);
        $cmdType = $dataArray[0];
        $cmdList = [
            "" => "",
            "ID1"       => VMCIDDataBlock::class,
            "DXS"       => DXSDataBlock::class,
            "ST"        => STDataBlock::class,
            "AM1"       => AuditModuleDataBlock::class,
            "ID4"       => CurrencyDataBlock::class,
            "ID5"       => TimeDataBlock::class,
            "ID6"       => CashBagDataBlock::class,
            "CB1"       => ControlBoardDataBlock::class,
            "VA1"       => VendsPaidDataBlock::class,
            "VA2"       => VendsTestDataBlock::class,
            "VA3"       => VendsFreeDataBlock::class,
            "CA1"       => CoinIDDataBlock::class,
            "CA2"       => CoinVendsDataBlock::class,
            "CA3"       => CashReportDataBlock::class,
            "CA4"       => DataBlock::class,
            "CA5"       => PowerOutDataBlock::class,
            "CA6"       => ReadsOpenDataBlock::class,

            "CA7"       => CashDiscountsDataBlock::class,
            "CA8"       => DataBlock::class,
            "CA9"       => CoinChangeDataBlock::class,
            "CA10"      => CashlessIDDataBlock::class,
            "CA11"      => CoinAcceptedDataBlock::class,
            "CA12"      => CoinDispensedDataBlock::class,
            "CA13"      => CoinFilledDataBlock::class,
            "CA14"      => BillAcceptedDataBlock::class,
            "CA15"      => CA15DataBlock::class,
            "CA16"      => CA16DataBlock::class,
            "CA17"      => CA17DataBlock::class,
            "CA18"      => CA18DataBlock::class,
            "CA19"      => CA19DataBlock::class,
            "CA20"      => CA20DataBlock::class,
            "CA21"      => CA21DataBlock::class,
            "CA22"      => CA22DataBlock::class,
            "CA23"      => CA23DataBlock::class,
            "CA24"      => CA24DataBlock::class,
            "BA1"       => BillIDDataBlock::class,
            "DA1"       => CashlessIDDataBlock::class,
            "DA2"       => CashlessVendsDataBlock::class,
            "DA3"       => DataBlock::class,
            "DA4"       => DataBlock::class,
            "DA5"       => CashlessDiscountsDataBlock::class,
            "DA7"       => DA7DataBlock::class,
            "DA10"      => DA10DataBlock::class,
            "MA5"       => MachineDataBlock::class,
            "MC5"       => DataBlock::class,

            "FA1"       => GatewayIDDataBlock::class,
            "PA1"       => ProductDataBlock::class,
            "PA2"       => ProductVendsDataBlock::class,
            "PA3"       => ProductTestVendsDataBlock::class,
            "PA4"       => ProductFreeVendsDataBlock::class,
            "PA5"       => PA5DataBlock::class,
            "PA6"       => PA6DataBlock::class,
            "PA7"       => ProductVendsNewDataBlock::class,
            "PA8"       => PA8DataBlock::class,
            "LA1"       => PriceListVendsDataBlock::class,
            "EA1"       => EventDataBlock::class,
            "EA2"       => EventDetailsDataBlock::class,
            "EA3"       => EA3DataBlock::class,
            "EA4"       => EA4DataBlock::class,
            "EA5"       => EA5DataBlock::class,
            "EA6"       => EA6DataBlock::class,
            "EA7"       => EA7DataBlock::class,
            "EA9"       => EA9DataBlock::class,
            "EA250705"  => EA250705DataBlock::class,
            "EADXS"     => EADXSDataBlock::class,
            "EC2"       => EC2DataBlock::class,
            "SA2"       => SA2DataBlock::class,
            "TA1"       => TimeDataBlock::class,
            "TA2"       => TA2DataBlock::class,
            "TA3"       => TA3DataBlock::class,
            "TA4"       => TA4DataBlock::class,
            "TA5"       => TA5DataBlock::class,
            "TA6"       => TA6DataBlock::class,
            "SD1"       => SD1DataBlock::class,
            "G85"       => G85DataBlock::class,
            "SE"        => SEDataBlock::class,
            "DXE"       => DXEDataBlock::class,
            "DB1"       => DB1DataBlock::class,
            "DB2"       => DB2DataBlock::class,
            "DB4"       => DB4DataBlock::class,
            "DB5"       => DB5DataBlock::class,
            "DB10"      => DB10DataBlock::class,
            "PP1"       => PP1DataBlock::class,
            "MA1"       => MA1DataBlock::class,
            
            // TA/TC blocks
            "TA10"      => TA10DataBlock::class,
            "TC10"      => TC10DataBlock::class,
            
            // Specialty blocks
            "BC12"      => BC12DataBlock::class,
            "BC92"      => BC92DataBlock::class,
            "BC98"      => BC98DataBlock::class,
            "EF15"      => EF15DataBlock::class,
            "IO57"      => IO57DataBlock::class,
            "KH85"      => KH85DataBlock::class,
            "RS76"      => RS76DataBlock::class,
            "ST76"      => ST76DataBlock::class,
            "UV12"      => UV12DataBlock::class,
            "VF61"      => VF61DataBlock::class,
            "VS07"      => VS07DataBlock::class,
            "VS98"      => VS98DataBlock::class,
            "WH94"      => WH94DataBlock::class,
            "YZ12"      => YZ12DataBlock::class,
        ];
        if (isset($cmdList[$cmdType])) {
            return class_exists($cmdList[$cmdType]) ? new $cmdList[$cmdType]($dataString) : null;
        } else {
            echo "unknown:" . $cmdType . ":" . $dataString . PHP_EOL;
        }
        return null;
    }

    /**
     * Parse an EVA DTS message string
     * 
     * Splits the star-separated EVA DTS line and stores the values
     * in the appropriate object properties based on the ASSIGNMENT mapping.
     * 
     * @param string $dataString The EVA DTS data string to parse
     * @return void
     * 
     * @example
     * ```php
     * $block = new ProductDataBlock();
     * $block->parse("PA1*1*Coffee*100*1");
     * echo $block->name; // "Coffee"
     * ```
     */
    public function parse($dataString)
    {
        $dataString = trim(preg_replace('/\s+/', ' ', $dataString));
        $dataArray = \explode("*", $dataString);
        $this->store($dataArray);
    }

    /**
     * Store parsed data array values into object properties
     * 
     * Maps array values to object properties based on the ASSIGNMENT
     * constant defined in each data block class.
     * 
     * @param array $dataArray Array of parsed values from EVA DTS string
     * @return void
     */
    public function store($dataArray)
    {
        if (is_array($dataArray)) {
            foreach ($dataArray as $key => $value) {
                $className =  get_called_class();
                $propertyName = $className::ASSIGNMENT[$key] ?? "";
                if (!empty($propertyName) && !empty($value) && \property_exists($this, $propertyName))
                    $this->$propertyName = $value;
            }
        }
    }

    public function __toString()
    {
        $dataArray = [];
        foreach (get_object_vars($this) as $key => $value) {
            if (!empty($value))
                $dataArray[$key] = $value;
        }
        return \implode("\t", $dataArray);
    }
}
