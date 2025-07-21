<?php

require_once __DIR__ . '/vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

// Test file
$testFile = __DIR__ . '/example/2025-06-20-13-46-Hewa Luce 1 #39 Links.txt';

echo "=== DEBUGGING getSalesData() PRICING ISSUE ===\n";

// Create parser and load file
$parser = new Parser();
$parser->load($testFile);

$salesData = $parser->getSalesData();

echo "=== SALES DATA FÜR PRODUKT 5 ===\n";
foreach ($salesData as $sale) {
    if ($sale['product_id'] == '5') {
        echo "Verkauf für Produkt 5:\n";
        echo "  product_id: " . $sale['product_id'] . "\n";
        echo "  pricelist_id: " . $sale['pricelist_id'] . "\n";
        echo "  amount: " . $sale['amount'] . " EUR\n";
        echo "  quantity: " . $sale['quantity'] . "\n";
        echo "  total_value: " . $sale['total_value'] . " EUR\n";
        echo "\n";
    }
}

echo "=== ALLE PRICELISTVENDS BLÖCKE FÜR PRODUKT 5 ===\n";

$report = $parser->getReport();
$blocks = $report->getBlocks();

foreach ($blocks as $block) {
    if ($block instanceof \PeanutPay\PhpEvaDts\PriceListVendsDataBlock && $block->productNumber == '5') {
        echo "PriceListVendsDataBlock für Produkt 5:\n";
        echo "  productNumber: " . $block->productNumber . "\n";
        echo "  priceList: " . $block->priceList . "\n";
        echo "  price: " . $block->price . " (Cent)\n";
        echo "  numberPaidInit: " . $block->numberPaidInit . "\n";
        echo "  numberPaidReset: " . $block->numberPaidReset . "\n";
        
        $salesCount = $block->numberPaidReset >= $block->numberPaidInit 
            ? $block->numberPaidReset - $block->numberPaidInit 
            : $block->numberPaidInit;
            
        echo "  calculated salesCount: " . $salesCount . "\n";
        echo "  unitPrice (price/100): " . ($block->price / 100) . " EUR\n";
        echo "  total_value: " . (($block->price / 100) * $salesCount) . " EUR\n";
        echo "  Would create sales entry: " . ($salesCount > 0 ? "YES" : "NO") . "\n";
        echo "\n";
    }
}
