<?php

require_once __DIR__ . '/vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;
use PeanutPay\PhpEvaDts\CoinAcceptedDataBlock;
use PeanutPay\PhpEvaDts\BillAcceptedDataBlock;

echo "=== COIN VS BILL DATABLOCK SEPARATION VERIFICATION ===\n\n";

// Test with a file that should have cashbox data
$testFile = __DIR__ . '/example/2024-06-05-15-16-Hewa Snack 138.txt';

if (!file_exists($testFile)) {
    echo "❌ Test file not found: $testFile\n";
    exit(1);
}

$parser = new Parser();
$parser->parse(file_get_contents($testFile));

echo "🔍 ANALYZING DATABLOCK MAPPINGS...\n\n";

// Check what blocks we have
$blocks = $parser->getReport()->getBlocks();
$ca11Blocks = [];
$ca14Blocks = [];

foreach ($blocks as $block) {
    if ($block instanceof CoinAcceptedDataBlock) {
        $ca11Blocks[] = $block;
    }
    if ($block instanceof BillAcceptedDataBlock) {
        $ca14Blocks[] = $block;
    }
}

echo "📊 BLOCK ANALYSIS:\n";
echo "- CA11 (Coin) blocks found: " . count($ca11Blocks) . "\n";
echo "- CA14 (Bill) blocks found: " . count($ca14Blocks) . "\n\n";

// Test the getCashboxData method
echo "💰 CASHBOX DATA ANALYSIS:\n";
$cashboxData = $parser->getCashboxData();

echo "Coins data:\n";
if (empty($cashboxData['coins'])) {
    echo "  ⚠️  No coin data found\n";
} else {
    foreach ($cashboxData['coins'] as $coin) {
        printf("  %.2f EUR: %d accepted (since reset)\n", 
               $coin['denomination'], $coin['total_accepted']);
    }
}

echo "\nBills data:\n";
if (empty($cashboxData['bills'])) {
    echo "  ⚠️  No bill data found\n";
} else {
    foreach ($cashboxData['bills'] as $bill) {
        printf("  %.2f EUR: %d accepted (since reset)\n", 
               $bill['denomination'], $bill['total_accepted']);
    }
}

echo "\nTotals:\n";
printf("  Coin value: %.2f EUR\n", $cashboxData['totals']['coin_value']);
printf("  Bill value: %.2f EUR\n", $cashboxData['totals']['bill_value']);
printf("  Total cash: %.2f EUR\n", $cashboxData['totals']['coin_value'] + $cashboxData['totals']['bill_value']);

echo "\n🔧 TECHNICAL VERIFICATION:\n";

// Check if CA11 blocks have the right fields
if (!empty($ca11Blocks)) {
    $ca11Block = $ca11Blocks[0];
    echo "CA11 (Coin) Block Properties:\n";
    echo "  - coinValue: " . ($ca11Block->coinValue ?? 'null') . "\n";
    echo "  - coinsAcceptedSinceReset: " . ($ca11Block->coinsAcceptedSinceReset ?? 'null') . "\n";
    echo "  - coinsToCashboxSinceReset: " . ($ca11Block->coinsToCashboxSinceReset ?? 'null') . "\n";
} else {
    echo "CA11 (Coin) Block: None found in this file\n";
}

if (!empty($ca14Blocks)) {
    $ca14Block = $ca14Blocks[0];
    echo "CA14 (Bill) Block Properties:\n";
    echo "  - billValue: " . ($ca14Block->billValue ?? 'null') . "\n";
    echo "  - billsInSinceReset: " . ($ca14Block->billsInSinceReset ?? 'null') . "\n";
    echo "  - billsToStackerSinceReset: " . ($ca14Block->billsToStackerSinceReset ?? 'null') . "\n";
} else {
    echo "CA14 (Bill) Block: None found in this file\n";
}

echo "\n✅ DATABLOCK SEPARATION TEST COMPLETED!\n";
