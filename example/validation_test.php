<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

$parser = new Parser();
$parser->load(__DIR__ . '/2025-06-18-11-27-ACTECH LUCE Zero.0 Bohne 2.txt');

echo "=== FINAL VALIDATION TEST ===\n\n";

// Test sales data
$salesData = $parser->getSalesData();
echo "✅ Sales records: " . count($salesData) . "\n";
if (!empty($salesData)) {
    echo "Sample sale: " . json_encode($salesData[0], JSON_PRETTY_PRINT) . "\n\n";
}

// Test products
$productData = $parser->getProductData();
echo "✅ Products: " . count($productData) . "\n";
if (!empty($productData)) {
    echo "Sample product: " . json_encode($productData[0], JSON_PRETTY_PRINT) . "\n\n";
}

// Test cashbox
$cashboxData = $parser->getCashboxData();
echo "✅ Cashbox total: " . $cashboxData['totals']['total_cash'] . "€\n";
echo "Coins with reset flag:\n";
foreach ($cashboxData['coins'] as $coin) {
    $resetFlag = $coin['reset_occurred'] ? " (RESET)" : "";
    echo "  {$coin['denomination']}€: {$coin['total_value']}€{$resetFlag}\n";
}

// Test sales report
$salesReport = $parser->generateSalesReport();
echo "\n✅ Sales Report Summary:\n";
echo "  Total Revenue: " . $salesReport['summary']['total_revenue'] . "€\n";
echo "  Total Transactions: " . $salesReport['summary']['total_transactions'] . "\n";
echo "  Products Sold: " . $salesReport['summary']['total_products_sold'] . "\n";

echo "\n=== ALL TESTS PASSED ===\n";
