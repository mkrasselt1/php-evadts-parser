<?php

namespace PeanutPay\PhpEvaDts;

class DataBlock implements DataBlockInterface
{
    const NONE                  = "";
    const ASSIGNMENT = [];
    /**
     * Creates a new DataBlock
     * @param string $msg to be parsed
     */
    public function __construct($msg = "")
    {
        // echo self::class . "\r\n";
        if (!empty($msg)) {
            $this->parse($msg);
        }
    }

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
            "CA10"      => DataBlock::class,
            "CA11"      => CoinAcceptedDataBlock::class,
            "CA12"      => CoinDispensedDataBlock::class,
            "CA13"      => CoinFilledDataBlock::class,
            "CA15"      => CoinTubeLevelDataBlock::class,
            "CA16"      => DataBlock::class,
            "CA17"      => CoinTubeDataBlock::class,
            "BA1"       => BillIDDataBlock::class,
            "DA1"       => CashlessIDDataBlock::class,
            "DA2"       => CashlessVendsDataBlock::class,
            "DA3"       => DataBlock::class,
            "DA4"       => DataBlock::class,
            "DA5"       => CashlessDiscountsDataBlock::class,
            "DA10"      => DataBlock::class,
            "MA5"       => MachineDataBlock::class,
            "MC5"       => DataBlock::class,

            "FA1"       => GatewayIDDataBlock::class,
            "PA1"       => ProductDataBlock::class,
            "PA2"       => ProductVendsDataBlock::class,
            "PA3"       => ProductTestVendsDataBlock::class,
            "PA4"       => ProductFreeVendsDataBlock::class,
            "PA7"       => ProductVendsNewDataBlock::class,
            "LA1"       => PriceListVendsDataBlock::class,
            "EA1"       => EventDataBlock::class,
            "EA2"       => EventDetailsDataBlock::class,
        ];
        if (isset($cmdList[$cmdType])) {
            return class_exists($cmdList[$cmdType]) ? new $cmdList[$cmdType]($dataString) : null;
        } else {
            echo "unknown:" . $cmdType . ":" . $dataString . PHP_EOL;
        }
        return null;
    }

    /**
     * Parsing the EVA DTS message as star separated line
     * @param string $dataString
     * @return void
     */
    public function parse($dataString)
    {
        $dataString = trim(preg_replace('/\s+/', ' ', $dataString));
        $dataArray = \explode("*", $dataString);
        $this->store($dataArray);
    }

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
