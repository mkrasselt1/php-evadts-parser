<?php

namespace PeanutPay\PhpEvaDts;

/**
 * EVA DTS (Electronic Vending Audit Data Transfer Standard) Parser
 * 
 * This class is responsible for parsing EVA DTS files from vending machines
 * and converting them into structured data blocks for analysis.
 * 
 * @package PeanutPay\PhpEvaDts
 * @author Michael Krasselt <michael@peanutpay.de>
 */
class Parser
{
    /**
     * Create a new Parser instance
     */
    public function __construct() {}

    /**
     * The parsed report containing all data blocks
     * @var Report|null
     */
    private $report = null;

    /**
     * Load and parse an EVA DTS file from disk
     * 
     * @param string $fileName Path to the EVA DTS file
     * @return bool True if parsing was successful, false otherwise
     * 
     * @example
     * ```php
     * $parser = new Parser();
     * if ($parser->load('/path/to/machine.eva_dts')) {
     *     $report = $parser->getReport();
     *     echo $report->generateSalesTableString();
     * }
     * ```
     */
    public function load(string $fileName = "")
    {
        $handle = fopen($fileName, "r");
        if ($handle) {
            $this->report = new Report();
            //if (($line = fgets($handle)) !== false) {
            while (($line = fgets($handle)) !== false) {
                $newDataBlock = DataBlock::create($line);
                if (!\is_null($newDataBlock)) {
                    $this->report->add($newDataBlock);
                }
            }
            fclose($handle);
            return true;
        }
        return false;
    }

    /**
     * Parse EVA DTS content from a string
     * 
     * @param string $fileContent The EVA DTS content as string
     * @return bool True if parsing was successful, false otherwise
     * 
     * @example
     * ```php
     * $content = file_get_contents('machine.eva_dts');
     * $parser = new Parser();
     * if ($parser->parse($content)) {
     *     $report = $parser->getReport();
     *     $salesData = $report->generateSalesTable();
     * }
     * ```
     */
    public function parse(string $fileContent = "")
    {
        $this->report = new Report();
        $lines = explode("\n", $fileContent);
        if (count($lines)) {
            foreach ($lines as $line) {
                $newDataBlock = DataBlock::create($line);
                if (!\is_null($newDataBlock)) {
                    $this->report->add($newDataBlock);
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Get the parsed report containing all data blocks
     * 
     * @return Report|null The report object or null if no data was parsed
     * 
     * @example
     * ```php
     * $parser = new Parser();
     * $parser->load('machine.eva_dts');
     * $report = $parser->getReport();
     * 
     * if ($report) {
     *     echo "Total products: " . count($report->generateSalesTable()['products']);
     * }
     * ```
     */
    public function getReport(): ?Report
    {
        return $this->report;
    }

    // =======================================
    // DATA EXTRACTION METHODS
    // =======================================

    /**
     * Return all parsed data tables as associative array with table names as keys
     * 
     * @return array Associative array containing all data tables
     */
    public function getTables(): array
    {
        if (!$this->report) {
            return [];
        }

        $tables = [
            'sales' => $this->getSalesData(),
            'products' => $this->getProductData(), 
            'cashbox' => $this->getCashboxData(),
            'audit' => $this->getAuditData(),
            'events' => $this->getEventData(),
            'machine_info' => $this->getMachineInfo(),
            'payment_systems' => $this->getPaymentSystemsData()
        ];

        return $tables;
    }

    /**
     * Extract sales transaction data with detailed transaction information
     * 
     * @return array Sales data with timestamps, amounts, product_ids, transaction_types
     */
    public function getSalesData(): array
    {
        if (!$this->report) {
            return [];
        }

        $salesData = [];
        $transactionId = 1;

        foreach ($this->report->getBlocks() as $block) {
            if ($block instanceof PriceListVendsDataBlock) {
                $numberPaidInit = (int)($block->numberPaidInit ?? 0);
                $numberPaidReset = (int)($block->numberPaidReset ?? 0);
                $price = (float)($block->price ?? 0);
                $salesCount = $numberPaidReset - $numberPaidInit;
                
                if ($salesCount > 0) {
                    $unitPrice = $price / 100;
                    $salesData[] = [
                        'transaction_id' => $transactionId++,
                        'timestamp' => date('Y-m-d H:i:s'), // EVA-DTS doesn't provide exact timestamps
                        'product_id' => $block->productNumber ?? 'unknown',
                        'pricelist_id' => $block->priceList ?? 0,
                        'amount' => $unitPrice,
                        'quantity' => $salesCount,
                        'total_value' => $unitPrice * $salesCount,
                        'transaction_type' => 'paid_vend',
                        'currency' => 'EUR', // Default, should be extracted from currency block
                        'payment_method' => 'unknown'
                    ];
                }
            }
            
            if ($block instanceof ProductTestVendsDataBlock) {
                $numberTestsInit = (int)($block->numberTestsInit ?? 0);
                $numberTestsReset = (int)($block->numberTestsReset ?? 0);
                $testVends = $numberTestsReset - $numberTestsInit;
                
                if ($testVends > 0) {
                    $salesData[] = [
                        'transaction_id' => $transactionId++,
                        'timestamp' => date('Y-m-d H:i:s'),
                        'product_id' => 'test_product',
                        'amount' => 0,
                        'quantity' => $testVends,
                        'total_value' => 0,
                        'transaction_type' => 'test_vend',
                        'currency' => 'EUR',
                        'payment_method' => 'test'
                    ];
                }
            }

            if ($block instanceof ProductFreeVendsDataBlock) {
                $numberFreeInit = (int)($block->numberFreeInit ?? 0);
                $numberFreeReset = (int)($block->numberFreeReset ?? 0);
                $freeVends = $numberFreeReset - $numberFreeInit;
                
                if ($freeVends > 0) {
                    $salesData[] = [
                        'transaction_id' => $transactionId++,
                        'timestamp' => date('Y-m-d H:i:s'),
                        'product_id' => 'free_product',
                        'amount' => 0,
                        'quantity' => $freeVends,
                        'total_value' => 0,
                        'transaction_type' => 'free_vend',
                        'currency' => 'EUR',
                        'payment_method' => 'free'
                    ];
                }
            }
        }

        return $salesData;
    }

    /**
     * Extract product information including details and stock levels
     * 
     * @return array Product data with id, name, price, category, stock_levels
     */
    public function getProductData(): array
    {
        if (!$this->report) {
            return [];
        }

        $products = [];
        $priceData = [];
        $salesData = [];

        // Collect price data
        foreach ($this->report->getBlocks() as $block) {
            if ($block instanceof PriceListVendsDataBlock) {
                $productNumber = $block->productNumber ?? 'unknown';
                $priceList = (int)($block->priceList ?? 0);
                $price = (float)($block->price ?? 0);
                $numberPaidInit = (int)($block->numberPaidInit ?? 0);
                $numberPaidReset = (int)($block->numberPaidReset ?? 0);
                $totalSales = $numberPaidReset - $numberPaidInit;
                
                $priceData[$productNumber] = [
                    'pricelist_id' => $priceList,
                    'price' => $price / 100,
                    'sales_init' => $numberPaidInit,
                    'sales_reset' => $numberPaidReset,
                    'total_sales' => $totalSales,
                    'total_revenue' => ($totalSales * $price) / 100
                ];
            }
        }

        // Collect product data
        foreach ($this->report->getBlocks() as $block) {
            if ($block instanceof ProductDataBlock) {
                $productId = $block->productNumber ?? 'unknown';
                $blockPrice = (float)($block->price ?? 0);
                $price = isset($priceData[$productId]) ? $priceData[$productId]['price'] : $blockPrice / 100;
                
                $products[$productId] = [
                    'product_id' => $productId,
                    'name' => $block->name ?: "Product $productId",
                    'price' => $price,
                    'active' => $block->active,
                    'category' => $this->determineProductCategory($block->name),
                    'stock_level' => 'unknown', // EVA-DTS doesn't typically include stock levels
                    'sales_data' => $priceData[$productId] ?? [
                        'total_sales' => 0,
                        'total_revenue' => 0
                    ]
                ];
            }
        }

        return array_values($products);
    }

    /**
     * Extract cashbox/till data including coin and bill counts
     * 
     * @return array Cashbox data with coin counts, bill counts, total amounts, timestamps
     */
    public function getCashboxData(): array
    {
        if (!$this->report) {
            return [];
        }

        $cashboxData = [
            'coins' => [],
            'bills' => [],
            'totals' => [
                'coin_value' => 0,
                'bill_value' => 0,
                'total_cash' => 0
            ],
            'tube_levels' => [],
            'cash_audit' => []
        ];

        foreach ($this->report->getBlocks() as $block) {
            if ($block instanceof CoinAcceptedDataBlock) {
                $coinValue = (float)($block->coinValue ?? 0) / 100;
                $amountInit = (int)($block->amountInInit ?? 0);
                $amountReset = (int)($block->amountInLastReset ?? 0);
                $totalAccepted = $amountReset - $amountInit;
                
                $cashboxData['coins'][] = [
                    'denomination' => $coinValue,
                    'count_init' => $amountInit,
                    'count_reset' => $amountReset,
                    'total_accepted' => $totalAccepted,
                    'total_value' => $totalAccepted * $coinValue
                ];
                $cashboxData['totals']['coin_value'] += $totalAccepted * $coinValue;
            }

            if ($block instanceof CoinTubeLevelDataBlock) {
                $tubeNumber = (int)($block->tubeNumber ?? 0);
                $coinValue = (float)($block->coinValue ?? 0) / 100;
                $coinCount = (int)($block->coinCount ?? 0);
                
                $cashboxData['tube_levels'][] = [
                    'tube_number' => $tubeNumber,
                    'coin_value' => $coinValue,
                    'count' => $coinCount,
                    'tube_status' => $block->tubeStatus ?? 'unknown',
                    'total_value' => $coinCount * $coinValue
                ];
            }

            if ($block instanceof CashReportDataBlock) {
                $cashInit = (float)($block->cashInit ?? 0) / 100;
                $cashReset = (float)($block->cashReset ?? 0) / 100;
                $tubeValueInit = (float)($block->tubeValueInit ?? 0) / 100;
                $tubeValueReset = (float)($block->tubeValueReset ?? 0) / 100;
                $billValueInit = (float)($block->billValueInit ?? 0) / 100;
                $billValueReset = (float)($block->billValueReset ?? 0) / 100;
                
                $cashboxData['cash_audit'] = [
                    'cash_init' => $cashInit,
                    'cash_reset' => $cashReset,
                    'cash_difference' => $cashReset - $cashInit,
                    'tube_value_init' => $tubeValueInit,
                    'tube_value_reset' => $tubeValueReset,
                    'bill_value_init' => $billValueInit,
                    'bill_value_reset' => $billValueReset
                ];
            }
        }

        $cashboxData['totals']['total_cash'] = $cashboxData['totals']['coin_value'] + $cashboxData['totals']['bill_value'];
        
        return $cashboxData;
    }

    /**
     * Extract audit trail information including timestamps and system changes
     * 
     * @return array Audit data with timestamps, events, user_actions, system_changes
     */
    public function getAuditData(): array
    {
        if (!$this->report) {
            return [];
        }

        $auditData = [
            'machine_audit' => [],
            'time_audit' => [],
            'selection_audit' => [],
            'system_changes' => []
        ];

        foreach ($this->report->getBlocks() as $block) {
            if ($block instanceof AuditModuleDataBlock) {
                $auditData['machine_audit'][] = [
                    'module_data' => $block->moduleData ?? 'N/A',
                    'timestamp' => date('Y-m-d H:i:s')
                ];
            }

            if ($block instanceof SA2DataBlock) {
                $auditData['selection_audit'][] = [
                    'selection_number' => $block->selectionNumber,
                    'number_selections' => $block->numberSelections,
                    'audit_data' => $block->field3,
                    'timestamp' => date('Y-m-d H:i:s')
                ];
            }

            if (method_exists($block, 'getField1') && 
                (strpos(get_class($block), 'TA') === strrpos(get_class($block), 'TA'))) {
                $auditData['time_audit'][] = [
                    'block_type' => get_class($block),
                    'data_block' => method_exists($block, '__toString') ? $block->__toString() : 'N/A',
                    'timestamp' => date('Y-m-d H:i:s')
                ];
            }
        }

        return $auditData;
    }

    /**
     * Extract general event log data with timestamps and event information
     * 
     * @return array Event data with timestamps, event_types, descriptions, severity_levels
     */
    public function getEventData(): array
    {
        if (!$this->report) {
            return [];
        }

        $events = [];
        $eventId = 1;

        foreach ($this->report->getBlocks() as $block) {
            if ($block instanceof EventDataBlock) {
                $events[] = [
                    'event_id' => $eventId++,
                    'event_code' => $block->eventId,
                    'timestamp' => $this->formatEventDateTime($block->date, $block->time),
                    'duration_seconds' => $block->durationS,
                    'duration_milliseconds' => $block->durationMs,
                    'payload' => $block->payload,
                    'event_type' => $this->categorizeEvent($block->eventId),
                    'severity_level' => $this->getEventSeverity($block->eventId),
                    'description' => $this->getEventDescription($block->eventId)
                ];
            }

            if ($block instanceof EventDetailsDataBlock) {
                $events[] = [
                    'event_id' => $eventId++,
                    'event_code' => 'DETAIL',
                    'timestamp' => date('Y-m-d H:i:s'),
                    'details' => $block->eventDetails ?? 'Event details',
                    'event_type' => 'system',
                    'severity_level' => 'info',
                    'description' => 'Event detail information'
                ];
            }
        }

        return $events;
    }

    // =======================================
    // REPORT GENERATION METHODS  
    // =======================================

    /**
     * Generate comprehensive sales analysis report
     * 
     * @return array Sales analysis with periodic summaries, revenue calculations, etc.
     */
    public function generateSalesReport(): array
    {
        if (!$this->report) {
            return [];
        }

        $salesData = $this->getSalesData();
        $productData = $this->getProductData();
        
        $report = [
            'summary' => [
                'total_transactions' => count($salesData),
                'total_revenue' => array_sum(array_column($salesData, 'total_value')),
                'average_transaction_value' => 0,
                'total_products_sold' => array_sum(array_column($salesData, 'quantity')),
                'active_products' => count(array_filter($productData, fn($p) => $p['active'])),
                'report_period' => [
                    'start' => date('Y-m-d H:i:s'),
                    'end' => date('Y-m-d H:i:s')
                ]
            ],
            'transaction_types' => [
                'paid_vends' => count(array_filter($salesData, fn($s) => $s['transaction_type'] === 'paid_vend')),
                'test_vends' => count(array_filter($salesData, fn($s) => $s['transaction_type'] === 'test_vend')),
                'free_vends' => count(array_filter($salesData, fn($s) => $s['transaction_type'] === 'free_vend'))
            ],
            'revenue_by_product' => [],
            'peak_sales_analysis' => [
                'hourly_distribution' => [],
                'daily_totals' => [],
                'busiest_hour' => '',
                'quietest_hour' => ''
            ]
        ];

        // Calculate average transaction value
        if (count($salesData) > 0) {
            $report['summary']['average_transaction_value'] = $report['summary']['total_revenue'] / count($salesData);
        }

        // Revenue by product analysis
        foreach ($productData as $product) {
            if (isset($product['sales_data'])) {
                $report['revenue_by_product'][] = [
                    'product_id' => $product['product_id'],
                    'product_name' => $product['name'],
                    'total_sales' => $product['sales_data']['total_sales'] ?? 0,
                    'total_revenue' => $product['sales_data']['total_revenue'] ?? 0,
                    'average_price' => $product['price']
                ];
            }
        }

        return $report;
    }

    /**
     * Generate product performance analysis report
     * 
     * @return array Product analysis with sales quantities, revenue, popularity rankings
     */
    public function generateProductReport(): array
    {
        if (!$this->report) {
            return [];
        }

        $productData = $this->getProductData();
        $salesData = $this->getSalesData();

        $report = [
            'product_performance' => [],
            'category_analysis' => [],
            'price_analysis' => [
                'average_price' => 0,
                'price_range' => ['min' => 0, 'max' => 0],
                'price_distribution' => []
            ],
            'stock_analysis' => [
                'total_products' => count($productData),
                'active_products' => count(array_filter($productData, fn($p) => $p['active'])),
                'inactive_products' => count(array_filter($productData, fn($p) => !$p['active']))
            ]
        ];

        // Product performance analysis
        foreach ($productData as $product) {
            $productSales = array_filter($salesData, fn($s) => $s['product_id'] == $product['product_id']);
            $totalQuantity = array_sum(array_column($productSales, 'quantity'));
            $totalRevenue = array_sum(array_column($productSales, 'total_value'));

            $report['product_performance'][] = [
                'product_id' => $product['product_id'],
                'name' => $product['name'],
                'category' => $product['category'],
                'price' => $product['price'],
                'total_quantity_sold' => $totalQuantity,
                'total_revenue' => $totalRevenue,
                'transaction_count' => count($productSales),
                'active' => $product['active'],
                'performance_score' => $totalRevenue > 0 ? ($totalRevenue * $totalQuantity) / 100 : 0
            ];
        }

        // Sort by performance score
        usort($report['product_performance'], fn($a, $b) => $b['performance_score'] <=> $a['performance_score']);

        // Price analysis
        $prices = array_column($productData, 'price');
        if (!empty($prices)) {
            $report['price_analysis']['average_price'] = array_sum($prices) / count($prices);
            $report['price_analysis']['price_range']['min'] = min($prices);
            $report['price_analysis']['price_range']['max'] = max($prices);
        }

        // Category analysis
        $categories = array_count_values(array_column($productData, 'category'));
        foreach ($categories as $category => $count) {
            $categoryProducts = array_filter($productData, fn($p) => $p['category'] === $category);
            $categoryRevenue = array_sum(array_column($categoryProducts, 'sales_data.total_revenue'));
            
            $report['category_analysis'][] = [
                'category' => $category,
                'product_count' => $count,
                'total_revenue' => $categoryRevenue,
                'average_price' => array_sum(array_column($categoryProducts, 'price')) / $count
            ];
        }

        return $report;
    }

    /**
     * Generate parsing and data validation error report
     * 
     * @return array Error report with parsing errors, data integrity issues, etc.
     */
    public function getErrorReport(): array
    {
        if (!$this->report) {
            return [
                'errors' => [['type' => 'no_data', 'message' => 'No report data available', 'severity' => 'critical']]
            ];
        }

        $errors = [];
        $warnings = [];
        $dataIntegrityIssues = [];

        $blocks = $this->report->getBlocks();
        
        // Check for data integrity issues
        $productIds = [];
        $pricelistData = [];
        
        foreach ($blocks as $block) {
            if ($block instanceof ProductDataBlock) {
                $productIds[] = $block->productNumber;
            }
            if ($block instanceof PriceListVendsDataBlock) {
                $pricelistData[$block->productNumber] = $block;
            }
        }

        // Check for products without pricing data
        foreach ($productIds as $productId) {
            if (!isset($pricelistData[$productId])) {
                $warnings[] = [
                    'type' => 'missing_price_data',
                    'message' => "Product {$productId} has no pricing information",
                    'severity' => 'warning',
                    'product_id' => $productId
                ];
            }
        }

        // Check for pricing data without product definitions
        foreach ($pricelistData as $productId => $priceData) {
            if (!in_array($productId, $productIds)) {
                $warnings[] = [
                    'type' => 'orphaned_price_data',
                    'message' => "Price data exists for undefined product {$productId}",
                    'severity' => 'warning',
                    'product_id' => $productId
                ];
            }
        }

        // Check for negative sales values
        foreach ($pricelistData as $productId => $priceData) {
            $salesDiff = $priceData->numberPaidReset - $priceData->numberPaidInit;
            if ($salesDiff < 0) {
                $dataIntegrityIssues[] = [
                    'type' => 'negative_sales',
                    'message' => "Product {$productId} has negative sales count: {$salesDiff}",
                    'severity' => 'error',
                    'product_id' => $productId,
                    'value' => $salesDiff
                ];
            }
        }

        return [
            'summary' => [
                'total_errors' => count($errors),
                'total_warnings' => count($warnings),
                'total_data_issues' => count($dataIntegrityIssues),
                'overall_health' => $this->calculateDataHealth($errors, $warnings, $dataIntegrityIssues)
            ],
            'errors' => $errors,
            'warnings' => $warnings,
            'data_integrity_issues' => $dataIntegrityIssues,
            'recommendations' => $this->generateRecommendations($errors, $warnings, $dataIntegrityIssues)
        ];
    }

    // =======================================
    // HELPER METHODS
    // =======================================

    /**
     * Get machine information from various data blocks
     * 
     * @return array Machine information
     */
    private function getMachineInfo(): array
    {
        if (!$this->report) {
            return [];
        }

        $machineInfo = [
            'machine_id' => '',
            'control_board' => '',
            'currency' => '',
            'location' => '',
            'version' => '',
            'audit_modules' => []
        ];

        foreach ($this->report->getBlocks() as $block) {
            if ($block instanceof VMCIDDataBlock) {
                $machineInfo['machine_id'] = $block->vmcId ?? '';
                $machineInfo['version'] = $block->version ?? '';
            }
            if ($block instanceof ControlBoardDataBlock) {
                $machineInfo['control_board'] = $block->controlBoardId ?? '';
            }
            if ($block instanceof CurrencyDataBlock) {
                $machineInfo['currency'] = $block->currencyCode ?? '';
            }
            if ($block instanceof MachineDataBlock) {
                $machineInfo['location'] = $block->location ?? '';
            }
            if ($block instanceof AuditModuleDataBlock) {
                $machineInfo['audit_modules'][] = [
                    'type' => $block->moduleType ?? '',
                    'id' => $block->moduleId ?? '',
                    'version' => $block->version ?? ''
                ];
            }
        }

        return $machineInfo;
    }

    /**
     * Get payment systems data
     * 
     * @return array Payment systems information
     */
    private function getPaymentSystemsData(): array
    {
        if (!$this->report) {
            return [];
        }

        $paymentSystems = [
            'coin_systems' => [],
            'bill_systems' => [],
            'cashless_systems' => []
        ];

        foreach ($this->report->getBlocks() as $block) {
            if ($block instanceof CoinIDDataBlock) {
                $paymentSystems['coin_systems'][] = [
                    'type' => 'coin_acceptor',
                    'id' => $block->coinAcceptorId ?? '',
                    'version' => $block->version ?? ''
                ];
            }
            if ($block instanceof BillIDDataBlock) {
                $paymentSystems['bill_systems'][] = [
                    'type' => 'bill_validator',
                    'id' => $block->billValidatorId ?? '',
                    'version' => $block->version ?? ''
                ];
            }
            if ($block instanceof CashlessIDDataBlock) {
                $paymentSystems['cashless_systems'][] = [
                    'type' => 'cashless_device',
                    'id' => $block->cashlessDeviceId ?? '',
                    'version' => $block->version ?? ''
                ];
            }
        }

        return $paymentSystems;
    }

    /**
     * Determine product category based on name
     * 
     * @param string $productName Product name
     * @return string Category name
     */
    private function determineProductCategory(string $productName): string
    {
        $name = strtolower($productName);
        
        if (strpos($name, 'coffee') !== false || strpos($name, 'espresso') !== false || strpos($name, 'cappuccino') !== false) {
            return 'hot_drinks';
        }
        if (strpos($name, 'cola') !== false || strpos($name, 'soda') !== false || strpos($name, 'water') !== false) {
            return 'cold_drinks';
        }
        if (strpos($name, 'chip') !== false || strpos($name, 'snack') !== false || strpos($name, 'candy') !== false) {
            return 'snacks';
        }
        if (strpos($name, 'sandwich') !== false || strpos($name, 'meal') !== false) {
            return 'food';
        }
        
        return 'other';
    }

    /**
     * Format event date and time
     * 
     * @param mixed $date Event date
     * @param mixed $time Event time  
     * @return string Formatted datetime
     */
    private function formatEventDateTime($date, $time): string
    {
        if (empty($date) || empty($time)) {
            return date('Y-m-d H:i:s');
        }
        
        // Handle different date formats
        if (strlen($date) == 8) {
            $dateObj = \DateTimeImmutable::createFromFormat('Ymd', $date);
        } else {
            $dateObj = \DateTimeImmutable::createFromFormat('ymd', $date);
        }
        
        // Handle different time formats
        if (strlen($time) == 4) {
            $timeObj = \DateTimeImmutable::createFromFormat('Hi', $time);
        } else {
            $timeObj = \DateTimeImmutable::createFromFormat('His', $time);
        }
        
        if ($dateObj && $timeObj) {
            return $dateObj->format('Y-m-d') . ' ' . $timeObj->format('H:i:s');
        }
        
        return date('Y-m-d H:i:s');
    }

    /**
     * Categorize event type
     * 
     * @param string $eventId Event ID
     * @return string Event category
     */
    private function categorizeEvent(string $eventId): string
    {
        $eventId = trim($eventId);
        
        if (strpos($eventId, 'EA') === 0) return 'coin';
        if (strpos($eventId, 'EB') === 0) return 'cup';
        if (strpos($eventId, 'EC') === 0) return 'control';
        if (strpos($eventId, 'EG') === 0) return 'cabinet';
        if (strpos($eventId, 'DEB') === 0) return 'debug';
        if (strpos($eventId, 'PTV') === 0) return 'product_test';
        if (strpos($eventId, 'PVD') === 0) return 'product_vend';
        if (strpos($eventId, 'PVE') === 0) return 'product_error';
        
        return 'system';
    }

    /**
     * Get event severity level
     * 
     * @param string $eventId Event ID
     * @return string Severity level
     */
    private function getEventSeverity(string $eventId): string
    {
        $eventId = trim($eventId);
        
        if (strpos($eventId, 'ERROR') !== false) return 'error';
        if (strpos($eventId, 'WARN') !== false) return 'warning';
        if (strpos($eventId, 'DEB') === 0) return 'debug';
        if (strpos($eventId, 'PVE') === 0) return 'error';
        
        return 'info';
    }

    /**
     * Get event description
     * 
     * @param string $eventId Event ID
     * @return string Event description
     */
    private function getEventDescription(string $eventId): string
    {
        $eventId = trim($eventId);
        
        $descriptions = [
            'DEB' => 'Debug information',
            'PTV' => 'Product test vend operation',
            'PVD' => 'Product vend dispensed successfully',
            'PVE' => 'Product vend error occurred',
            'RESET' => 'System reset operation',
            'KONF' => 'Configuration change'
        ];
        
        return $descriptions[$eventId] ?? "Event: $eventId";
    }

    /**
     * Calculate overall data health score
     * 
     * @param array $errors Errors array
     * @param array $warnings Warnings array
     * @param array $dataIssues Data integrity issues array
     * @return string Health status
     */
    private function calculateDataHealth(array $errors, array $warnings, array $dataIssues): string
    {
        $totalIssues = count($errors) + count($warnings) + count($dataIssues);
        
        if ($totalIssues === 0) return 'excellent';
        if ($totalIssues <= 2) return 'good';
        if ($totalIssues <= 5) return 'fair';
        
        return 'poor';
    }

    /**
     * Generate recommendations based on errors and warnings
     * 
     * @param array $errors Errors array
     * @param array $warnings Warnings array  
     * @param array $dataIssues Data integrity issues array
     * @return array Recommendations array
     */
    private function generateRecommendations(array $errors, array $warnings, array $dataIssues): array
    {
        $recommendations = [];
        
        if (count($dataIssues) > 0) {
            $recommendations[] = 'Review data integrity issues and verify machine configuration';
        }
        
        if (count($warnings) > 2) {
            $recommendations[] = 'Address missing data relationships between products and pricing';
        }
        
        if (count($errors) > 0) {
            $recommendations[] = 'Critical errors found - immediate attention required';
        }
        
        if (empty($recommendations)) {
            $recommendations[] = 'Data quality is good - no immediate action required';
        }
        
        return $recommendations;
    }
}
