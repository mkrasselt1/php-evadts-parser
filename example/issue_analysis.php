<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

// Detailed analysis of specific issues found
$testFile = __DIR__ . '/2025-06-18-11-27-ACTECH LUCE Zero.0 Bohne 2.txt';

echo "=== DETAILED ANALYSIS OF POTENTIAL ISSUES ===\n\n";

$parser = new Parser();
$parser->load($testFile);

// Issue 1: No sales data despite having products
echo "1. SALES DATA ANALYSIS:\n";
$salesData = $parser->getSalesData();
$productData = $parser->getProductData();

echo "Sales records found: " . count($salesData) . "\n";
echo "Products found: " . count($productData) . "\n";

if (count($salesData) === 0 && count($productData) > 0) {
    echo "⚠️ WARNING: Products exist but no sales data found\n";
    
    // Check if products have sales in their data
    $productsWithSales = 0;
    foreach ($productData as $product) {
        if (isset($product['sales_data']['total_sales']) && $product['sales_data']['total_sales'] > 0) {
            $productsWithSales++;
        }
    }
    echo "Products with sales data: $productsWithSales\n";
}

// Issue 2: Negative cashbox value
echo "\n2. CASHBOX DATA ANALYSIS:\n";
$cashboxData = $parser->getCashboxData();
echo "Total coin value: " . $cashboxData['totals']['coin_value'] . "\n";

if ($cashboxData['totals']['coin_value'] < 0) {
    echo "⚠️ WARNING: Negative coin value detected\n";
    echo "Coin entries:\n";
    foreach ($cashboxData['coins'] as $coin) {
        echo "  Denomination: " . $coin['denomination'] . " - Init: " . $coin['count_init'] . " - Reset: " . $coin['count_reset'] . " - Accepted: " . $coin['total_accepted'] . "\n";
    }
}

// Issue 3: Product prices are 0
echo "\n3. PRODUCT PRICING ANALYSIS:\n";
$zeroPrice = 0;
$nonZeroPrice = 0;

foreach ($productData as $product) {
    if ($product['price'] == 0) {
        $zeroPrice++;
    } else {
        $nonZeroPrice++;
    }
}

echo "Products with zero price: $zeroPrice\n";
echo "Products with non-zero price: $nonZeroPrice\n";

if ($zeroPrice > 0) {
    echo "⚠️ WARNING: Some products have zero prices\n";
    echo "Sample zero-price products:\n";
    $count = 0;
    foreach ($productData as $product) {
        if ($product['price'] == 0 && $count < 3) {
            echo "  - {$product['name']} (ID: {$product['product_id']})\n";
            $count++;
        }
    }
}

// Issue 4: Check raw data blocks for price information
echo "\n4. RAW DATA BLOCK ANALYSIS:\n";
$report = $parser->getReport();
$blocks = $report->getBlocks();

$priceListBlocks = 0;
$productBlocks = 0;

foreach ($blocks as $block) {
    if ($block instanceof \PeanutPay\PhpEvaDts\PriceListVendsDataBlock) {
        $priceListBlocks++;
        if ($priceListBlocks <= 3) {
            echo "PriceList Block - Product: " . ($block->productNumber ?? 'N/A') . 
                 " Price: " . ($block->price ?? 'N/A') . 
                 " Paid Init: " . ($block->numberPaidInit ?? 'N/A') . 
                 " Paid Reset: " . ($block->numberPaidReset ?? 'N/A') . "\n";
        }
    }
    if ($block instanceof \PeanutPay\PhpEvaDts\ProductDataBlock) {
        $productBlocks++;
    }
}

echo "PriceListVendsDataBlocks found: $priceListBlocks\n";
echo "ProductDataBlocks found: $productBlocks\n";

// Issue 5: Check for file content issues
echo "\n5. FILE CONTENT VERIFICATION:\n";
$content = file_get_contents($testFile);
$lines = explode("\n", $content);
echo "Total lines in file: " . count($lines) . "\n";
echo "Non-empty lines: " . count(array_filter($lines, 'trim')) . "\n";

// Show first few lines to verify format
echo "First 5 lines:\n";
for ($i = 0; $i < min(5, count($lines)); $i++) {
    echo "Line " . ($i+1) . ": " . trim($lines[$i]) . "\n";
}

// Issue 6: Test specific property access
echo "\n6. PROPERTY ACCESS TEST:\n";
foreach ($blocks as $block) {
    if ($block instanceof \PeanutPay\PhpEvaDts\PriceListVendsDataBlock) {
        echo "Testing PriceListVendsDataBlock properties:\n";
        echo "  productNumber: " . var_export($block->productNumber ?? 'NOT_SET', true) . "\n";
        echo "  price: " . var_export($block->price ?? 'NOT_SET', true) . "\n";
        echo "  numberPaidInit: " . var_export($block->numberPaidInit ?? 'NOT_SET', true) . "\n";
        echo "  numberPaidReset: " . var_export($block->numberPaidReset ?? 'NOT_SET', true) . "\n";
        break; // Only test first one
    }
}

echo "\n=== ANALYSIS COMPLETED ===\n";
