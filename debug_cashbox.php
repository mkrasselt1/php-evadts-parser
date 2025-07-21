<?php

require_once __DIR__ . '/vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

// Test file
$testFile = __DIR__ . '/example/2025-06-20-13-46-Hewa Luce 1 #39 Links.txt';

echo "=== DEBUGGING getCashboxData() ===\n";

// Create parser and load file
$parser = new Parser();
$parser->load($testFile);

echo "=== getCashboxData() RESULT ===\n";
$cashboxData = $parser->getCashboxData();
print_r($cashboxData);

echo "\n=== SEARCHING FOR CASHBOX RELATED DATA BLOCKS ===\n";

$report = $parser->getReport();
$blocks = $report->getBlocks();

$cashboxBlocks = [
    'CoinAcceptedDataBlock',
    'CoinTubeLevelDataBlock', 
    'CashReportDataBlock',
    'CoinChangeDataBlock',
    'CoinDispensedDataBlock',
    'CoinFilledDataBlock',
    'CoinVendsDataBlock'
];

echo "Searching for these cashbox block types:\n";
foreach ($cashboxBlocks as $blockType) {
    echo "- $blockType\n";
}

echo "\nFound blocks:\n";
$foundCashboxBlocks = [];

foreach ($blocks as $block) {
    $className = get_class($block);
    $shortName = str_replace('PeanutPay\\PhpEvaDts\\', '', $className);
    
    if (in_array($shortName, $cashboxBlocks)) {
        $foundCashboxBlocks[] = $shortName;
        echo "✅ Found: $shortName\n";
        echo "   toString(): " . $block->__toString() . "\n";
    }
}

if (empty($foundCashboxBlocks)) {
    echo "❌ No cashbox-related blocks found!\n";
}

echo "\n=== ALL AVAILABLE BLOCK TYPES ===\n";
$allBlockTypes = [];
foreach ($blocks as $block) {
    $className = get_class($block);
    $shortName = str_replace('PeanutPay\\PhpEvaDts\\', '', $className);
    $allBlockTypes[$shortName] = ($allBlockTypes[$shortName] ?? 0) + 1;
}

foreach ($allBlockTypes as $type => $count) {
    echo "$type: $count\n";
}

echo "\n=== SEARCHING FOR COIN/CASH RELATED LINES IN FILE ===\n";
$content = file_get_contents($testFile);
$lines = explode("\n", $content);

$cashPatterns = ['CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ'];

foreach ($lines as $lineNum => $line) {
    $line = trim($line);
    if (empty($line)) continue;
    
    foreach ($cashPatterns as $pattern) {
        if (strpos($line, $pattern) === 0) {
            echo "Zeile " . ($lineNum + 1) . ": $line\n";
            break;
        }
    }
}
