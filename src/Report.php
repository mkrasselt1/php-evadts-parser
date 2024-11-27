<?php

namespace PeanutPay\PhpEvaDts;

class Report
{
    public function __construct()
    {
    }

    /**
     * @var DataBlock[] $all the blocks of the report
     */
    private $blocks = [];

    private $priceListHeader = false;
    private $productListHeader = false;
    private $productVendsListHeader = false;
    private $productTestVendsListHeader = false;

    public function add(DataBlockInterface $newBlock)
    {
        $this->blocks[] = $newBlock;
    }

    public function __toString()
    {
        $dataArray = [];
        foreach ($this->blocks as $key => $value) {
            if (!empty($value)) {
                switch (\get_class($value)) {
                    case PriceListVendsDataBlock::class:
                        $dataArray[$key] = $value->toString($this->priceListHeader);
                        $this->priceListHeader = true;
                        break;
                    case ProductDataBlock::class:
                        $dataArray[$key] = $value;
                        $this->productListHeader = false;
                        break;
                    case ProductVendsDataBlock::class:
                        $dataArray[$key] = $value->toString($this->productVendsListHeader);
                        $this->productVendsListHeader = true;
                        break;
                    case ProductTestVendsDataBlock::class:
                        $dataArray[$key] = $value->toString($this->productTestVendsListHeader);
                        $this->productTestVendsListHeader = true;
                        break;
                    default:
                        $dataArray[$key] = $value;
                }
            }
        }
        return \implode("\n\r", $dataArray) . "\n\r";
    }
}
