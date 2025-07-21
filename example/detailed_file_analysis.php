<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

$testFile = __DIR__ . '/2025-06-20-13-46-Hewa Luce 1 #39 Links.txt';

echo "=== DETAILED ANALYSIS: Hewa Luce File ===\n\n";

$parser = new Parser();
$parser->load($testFile);

echo "1. FILE BASIC INFO:\n";
echo "File size: " . filesize($testFile) . " bytes\n";
echo "File exists: " . (file_exists($testFile) ? 'YES' : 'NO') . "\n\n";

echo "2. SALES DATA BREAKDOWN:\n";
$salesData = $parser->getSalesData();
echo "Total sales transactions: " . count($salesData) . "\n";

$totalRevenue = 0;
$totalQuantity = 0;
foreach ($salesData as $sale) {
    $totalRevenue += $sale['total_value'];
    $totalQuantity += $sale['quantity'];
}

echo "Total revenue: " . number_format($totalRevenue, 2) . "€\n";
echo "Total products sold: " . $totalQuantity . "\n\n";

// Show top 5 products by sales
echo "Top 5 products by quantity:\n";
usort($salesData, function($a, $b) { return $b['quantity'] <=> $a['quantity']; });
for ($i = 0; $i < min(5, count($salesData)); $i++) {
    $sale = $salesData[$i];
    echo "  Product {$sale['product_id']}: {$sale['quantity']} sold, {$sale['total_value']}€\n";
}

echo "\n3. PRODUCT DATA:\n";
$productData = $parser->getProductData();
echo "Total products configured: " . count($productData) . "\n";

$activeProducts = array_filter($productData, fn($p) => $p['active']);
echo "Active products: " . count($activeProducts) . "\n";

echo "Sample products with prices:\n";
for ($i = 0; $i < min(3, count($productData)); $i++) {
    $product = $productData[$i];
    echo "  {$product['name']} (ID: {$product['product_id']}): {$product['price']}€\n";
}

echo "\n4. CASHBOX DATA:\n";
$cashboxData = $parser->getCashboxData();
echo "Coin value: " . $cashboxData['totals']['coin_value'] . "€\n";
echo "Bill value: " . $cashboxData['totals']['bill_value'] . "€\n";
echo "Total cash: " . $cashboxData['totals']['total_cash'] . "€\n";

echo "Coin details:\n";
foreach ($cashboxData['coins'] as $coin) {
    echo "  {$coin['denomination']}€: {$coin['total_accepted']} coins = {$coin['total_value']}€\n";
}

echo "\n5. EVENTS:\n";
$events = $parser->getEventData();
echo "Total events: " . count($events) . "\n";

$eventTypes = [];
foreach ($events as $event) {
    $type = $event['event_type'];
    $eventTypes[$type] = ($eventTypes[$type] ?? 0) + 1;
}

echo "Event types:\n";
foreach ($eventTypes as $type => $count) {
    echo "  $type: $count\n";
}

echo "\n6. RAW DATA INSPECTION:\n";
$report = $parser->getReport();
$blocks = $report->getBlocks();

// Check for specific data blocks
$priceListBlocks = array_filter($blocks, fn($b) => $b instanceof \PeanutPay\PhpEvaDts\PriceListVendsDataBlock);
echo "PriceListVendsDataBlocks: " . count($priceListBlocks) . "\n";

// Show sample price data
foreach (array_slice($priceListBlocks, 0, 3) as $block) {
    $numberPaidInit = (int)($block->numberPaidInit ?? 0);
    $numberPaidReset = (int)($block->numberPaidReset ?? 0);
    $price = (float)($block->price ?? 0);
    $productNumber = $block->productNumber ?? 'unknown';
    
    echo "  Product {$productNumber}: Price={$price}, Init={$numberPaidInit}, Reset={$numberPaidReset}\n";
}

echo "\n=== ANALYSIS COMPLETE ===\n";
