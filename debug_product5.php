<?php

require_once __DIR__ . '/vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

// Test file
$testFile = __DIR__ . '/example/2025-06-20-13-46-Hewa Luce 1 #39 Links.txt';

echo "=== DEBUGGING PRODUCT 5 PRICING ISSUE ===\n";

// Create parser and load file
$parser = new Parser();
$parser->load($testFile);

$productData = $parser->getProductData();

echo "=== ALLE PRODUKTE ===\n";
foreach ($productData as $product) {
    if ($product['product_id'] == '5') {
        echo "Produkt 5 gefunden:\n";
        echo "  product_id: " . $product['product_id'] . "\n";
        echo "  name: " . $product['name'] . "\n";
        echo "  price: " . $product['price'] . "\n";
        echo "  active: " . ($product['active'] ? 'true' : 'false') . "\n";
        echo "  sales_data: " . json_encode($product['sales_data'], JSON_PRETTY_PRINT) . "\n";
        break;
    }
}

echo "\n=== DATENBLOCK ANALYSE FÜR PRODUKT 5 ===\n";

$report = $parser->getReport();
$blocks = $report->getBlocks();

echo "Alle Datenblöcke für Produkt 5:\n\n";

foreach ($blocks as $block) {
    $className = get_class($block);
    $shortName = str_replace('PeanutPay\\PhpEvaDts\\', '', $className);
    
    // Prüfe PA1 Blöcke (ProductDataBlock)
    if ($block instanceof \PeanutPay\PhpEvaDts\ProductDataBlock && $block->productNumber == '5') {
        echo "PA1 Block (ProductDataBlock) für Produkt 5:\n";
        echo "  productNumber: " . $block->productNumber . "\n";
        echo "  name: " . $block->name . "\n";
        echo "  price: " . $block->price . " (Cent)\n";
        echo "  active: " . ($block->active ? 'true' : 'false') . "\n";
        echo "  Converted price: " . ($block->price / 100) . " EUR\n";
        echo "  toString(): " . $block->__toString() . "\n\n";
    }
    
    // Prüfe DA1 Blöcke (PriceListVendsDataBlock)
    if ($block instanceof \PeanutPay\PhpEvaDts\PriceListVendsDataBlock && $block->productNumber == '5') {
        echo "DA1 Block (PriceListVendsDataBlock) für Produkt 5:\n";
        echo "  productNumber: " . $block->productNumber . "\n";
        echo "  priceList: " . $block->priceList . "\n";
        echo "  price: " . $block->price . " (Cent)\n";
        echo "  numberPaidInit: " . $block->numberPaidInit . "\n";
        echo "  numberPaidReset: " . $block->numberPaidReset . "\n";
        echo "  Converted price: " . ($block->price / 100) . " EUR\n";
        echo "  toString(): " . $block->__toString() . "\n\n";
    }
}

echo "=== ROHE ZEILEN AUS DER DATEI ===\n";
$content = file_get_contents($testFile);
$lines = explode("\n", $content);

foreach ($lines as $lineNum => $line) {
    if (strpos($line, 'PA1*5*') === 0 || strpos($line, 'DA1*5*') === 0) {
        echo "Zeile " . ($lineNum + 1) . ": " . trim($line) . "\n";
    }
}
