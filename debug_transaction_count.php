<?php

require_once __DIR__ . '/vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

// Test file
$testFile = __DIR__ . '/example/2025-06-20-13-46-Hewa Luce 1 #39 Links.txt';

echo "=== ANALYZING TRANSACTION COUNT vs PRODUCT SALES DISCREPANCY ===\n";

// Create parser and load file
$parser = new Parser();
$parser->load($testFile);

$salesData = $parser->getSalesData();
$productData = $parser->getProductData();

echo "=== TRANSACTION SUMMARY ===\n";
echo "Total transactions: " . count($salesData) . "\n";
echo "Total products sold: " . array_sum(array_column($salesData, 'quantity')) . "\n\n";

echo "=== DETAILED TRANSACTION ANALYSIS ===\n";
foreach ($salesData as $i => $sale) {
    echo "Transaction " . ($i + 1) . ":\n";
    echo "  Product ID: " . $sale['product_id'] . "\n";
    echo "  Pricelist ID: " . $sale['pricelist_id'] . "\n";
    echo "  Quantity: " . $sale['quantity'] . "\n";
    echo "  Amount: " . $sale['amount'] . " EUR\n";
    echo "  Total Value: " . $sale['total_value'] . " EUR\n";
    echo "\n";
}

echo "=== PRODUCT-WISE SALES BREAKDOWN ===\n";
foreach ($productData as $product) {
    if (isset($product['sales_data']['total_sales']) && $product['sales_data']['total_sales'] > 0) {
        echo "Product " . $product['product_id'] . " (" . $product['name'] . "):\n";
        echo "  Total Sales: " . $product['sales_data']['total_sales'] . "\n";
        echo "  Revenue: " . $product['sales_data']['total_revenue'] . " EUR\n";
        
        // Find matching transactions
        $matchingTransactions = array_filter($salesData, fn($s) => $s['product_id'] == $product['product_id']);
        echo "  Transactions: " . count($matchingTransactions) . "\n";
        foreach ($matchingTransactions as $trans) {
            echo "    - Pricelist " . $trans['pricelist_id'] . ": " . $trans['quantity'] . " units\n";
        }
        echo "\n";
    }
}

echo "=== RAW PRICELIST DATA ANALYSIS ===\n";
$report = $parser->getReport();
$blocks = $report->getBlocks();

foreach ($blocks as $block) {
    if ($block instanceof \PeanutPay\PhpEvaDts\PriceListVendsDataBlock) {
        $productNumber = $block->productNumber ?? 'unknown';
        $priceList = $block->priceList ?? 0;
        $numberPaidInit = (int)($block->numberPaidInit ?? 0);
        $numberPaidReset = (int)($block->numberPaidReset ?? 0);
        
        $salesCount = $numberPaidReset >= $numberPaidInit 
            ? $numberPaidReset - $numberPaidInit 
            : $numberPaidInit;
            
        if ($salesCount > 0) {
            echo "DA1 Block: Product $productNumber, Pricelist $priceList\n";
            echo "  Init: $numberPaidInit, Reset: $numberPaidReset\n";
            echo "  Calculated Sales: $salesCount\n";
            echo "  Raw line: " . $block->__toString() . "\n\n";
        }
    }
}
