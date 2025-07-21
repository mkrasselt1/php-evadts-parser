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

    /**
     * Get all data blocks in this report
     * 
     * @return DataBlock[] Array of data blocks
     */
    public function getBlocks(): array
    {
        return $this->blocks;
    }

    /**
     * Generates a structured array/table containing all pricelists, products and their sales data
     * @return array
     */
    public function generateSalesTable()
    {
        $salesTable = [
            'pricelists' => [],
            'products' => [],
            'summary' => [
                'total_pricelists' => 0,
                'total_products' => 0,
                'total_sales_amount' => 0,
                'total_sales_value' => 0
            ]
        ];

        $pricelistData = [];
        $productData = [];
        $productVendsData = [];

        // Group data by type
        foreach ($this->blocks as $block) {
            if (!empty($block)) {
                if ($block instanceof PriceListVendsDataBlock) {
                    $pricelistData[] = $block;
                } elseif ($block instanceof ProductDataBlock) {
                    $productData[] = $block;
                } elseif ($block instanceof ProductVendsDataBlock) {
                    $productVendsData[] = $block;
                }
            }
        }

        // Process pricelists
        $pricelistsByNumber = [];
        foreach ($pricelistData as $pricelistBlock) {
            /** @var PriceListVendsDataBlock $pricelistBlock */
            $priceList = $pricelistBlock->priceList;
            $productNumber = $pricelistBlock->productNumber;
            
            if (!isset($pricelistsByNumber[$priceList])) {
                $pricelistsByNumber[$priceList] = [
                    'pricelist_id' => $priceList,
                    'products' => [],
                    'total_products' => 0
                ];
            }
            
            $pricelistsByNumber[$priceList]['products'][$productNumber] = [
                'product_number' => $productNumber,
                'price' => $pricelistBlock->price / 100, // Convert to currency units
                'number_paid_init' => $pricelistBlock->numberPaidInit,
                'number_paid_reset' => $pricelistBlock->numberPaidReset,
                'total_sales_amount' => $pricelistBlock->numberPaidReset - $pricelistBlock->numberPaidInit,
                'total_sales_value' => ($pricelistBlock->numberPaidReset - $pricelistBlock->numberPaidInit) * ($pricelistBlock->price / 100)
            ];
            
            $pricelistsByNumber[$priceList]['total_products']++;
        }

        // Process products to get names
        $productsByNumber = [];
        foreach ($productData as $productBlock) {
            /** @var ProductDataBlock $productBlock */
            $productsByNumber[$productBlock->productNumber] = [
                'product_number' => $productBlock->productNumber,
                'name' => $productBlock->name,
                'price' => $productBlock->price / 100,
                'active' => $productBlock->active,
                'sales_amount' => 0,
                'sales_value' => 0
            ];
        }

        // Process product vends data
        foreach ($productVendsData as $vendsBlock) {
            /** @var ProductVendsDataBlock $vendsBlock */
            // This seems to be aggregate data, not per-product
            $salesTable['summary']['total_sales_amount'] += $vendsBlock->numberProductsReset - $vendsBlock->numberProductsInit;
            $salesTable['summary']['total_sales_value'] += ($vendsBlock->valueProductsReset - $vendsBlock->valueProductsInit) / 100;
        }

        // Merge product data with pricelist data
        foreach ($pricelistsByNumber as $pricelistId => &$pricelist) {
            foreach ($pricelist['products'] as $productNumber => &$product) {
                if (isset($productsByNumber[$productNumber])) {
                    $product['name'] = $productsByNumber[$productNumber]['name'];
                    $product['active'] = $productsByNumber[$productNumber]['active'];
                    
                    // Update product sales data
                    $productsByNumber[$productNumber]['sales_amount'] += $product['total_sales_amount'];
                    $productsByNumber[$productNumber]['sales_value'] += $product['total_sales_value'];
                } else {
                    $product['name'] = 'Unknown Product';
                    $product['active'] = false;
                }
            }
        }

        $salesTable['pricelists'] = array_values($pricelistsByNumber);
        $salesTable['products'] = array_values($productsByNumber);
        
        // Update summary
        $salesTable['summary']['total_pricelists'] = count($pricelistsByNumber);
        $salesTable['summary']['total_products'] = count($productsByNumber);

        return $salesTable;
    }

    /**
     * Formats the sales table as a readable console table string using ConsoleTable
     * @return string
     */
    public function generateSalesTableString()
    {
        $salesTable = $this->generateSalesTable();
        $output = "";
        
        // Header
        $output .= "===============================================\n";
        $output .= "               EVA DTS SALES REPORT\n";
        $output .= "===============================================\n\n";
        
        // Summary Table
        $summaryTable = new ConsoleTable();
        $summaryTable->setHeaders(['Metric', 'Value'])
                     ->addRows([
                         ['Total Pricelists', $salesTable['summary']['total_pricelists']],
                         ['Total Products', $salesTable['summary']['total_products']],
                         ['Total Sales Amount', number_format($salesTable['summary']['total_sales_amount'])],
                         ['Total Sales Value', number_format($salesTable['summary']['total_sales_value'], 2)]
                     ]);
        
        $output .= $summaryTable->render('SUMMARY');
        $output .= "\n";
        
        // Pricelists Tables
        if (!empty($salesTable['pricelists'])) {
            foreach ($salesTable['pricelists'] as $pricelist) {
                $pricelistTable = new ConsoleTable();
                $pricelistTable->setHeaders([
                    'Product #', 'Name', 'Price', 'Init Count', 'Reset Count', 'Sales Amount', 'Sales Value', 'Status'
                ]);
                
                $rows = [];
                foreach ($pricelist['products'] as $product) {
                    $rows[] = [
                        $product['product_number'],
                        substr($product['name'] ?: 'N/A', 0, 25),
                        number_format($product['price'], 2),
                        number_format($product['number_paid_init']),
                        number_format($product['number_paid_reset']),
                        number_format($product['total_sales_amount']),
                        number_format($product['total_sales_value'], 2),
                        $product['active'] ? 'Active' : 'Inactive'
                    ];
                }
                
                $pricelistTable->addRows($rows);
                $title = sprintf('PRICELIST %d (%d products)', $pricelist['pricelist_id'], $pricelist['total_products']);
                $output .= $pricelistTable->render($title);
                $output .= "\n";
            }
        } else {
            $output .= "No pricelist data found\n\n";
        }
        
        // All Products Summary Table
        if (!empty($salesTable['products'])) {
            $productsTable = new ConsoleTable();
            $productsTable->setHeaders([
                'Product #', 'Name', 'Price', 'Total Sales', 'Total Value', 'Status'
            ]);
            
            $rows = [];
            foreach ($salesTable['products'] as $product) {
                $rows[] = [
                    $product['product_number'],
                    substr($product['name'] ?: 'N/A', 0, 30),
                    number_format($product['price'], 2),
                    number_format($product['sales_amount']),
                    number_format($product['sales_value'], 2),
                    $product['active'] ? 'Active' : 'Inactive'
                ];
            }
            
            $productsTable->addRows($rows);
            $output .= $productsTable->render('PRODUCTS SUMMARY');
            $output .= "\n";
        }
        
        $output .= str_repeat("=", 50) . "\n";
        $output .= "Report generated: " . date('Y-m-d H:i:s') . "\n";
        $output .= str_repeat("=", 50) . "\n";
        
        return $output;
    }

    public function __toString()
    {
        $dataArray = [];
        foreach ($this->blocks as $key => $value) {
            if (!empty($value)) {
                if ($value instanceof PriceListVendsDataBlock) {
                    $dataArray[$key] = $value->toString($this->priceListHeader);
                    $this->priceListHeader = true;
                } elseif ($value instanceof ProductDataBlock) {
                    $dataArray[$key] = $value;
                    $this->productListHeader = false;
                } elseif ($value instanceof ProductVendsDataBlock) {
                    $dataArray[$key] = $value->toString($this->productVendsListHeader);
                    $this->productVendsListHeader = true;
                } elseif ($value instanceof ProductTestVendsDataBlock) {
                    $dataArray[$key] = $value->toString($this->productTestVendsListHeader);
                    $this->productTestVendsListHeader = true;
                } else {
                    $dataArray[$key] = $value;
                }
            }
        }
        return \implode("\n\r", $dataArray) . "\n\r";
    }
}
