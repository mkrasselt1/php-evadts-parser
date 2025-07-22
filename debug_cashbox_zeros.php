<?php

require_once __DIR__ . '/vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

// Test file
$testFile = __DIR__ . '/example/2025-06-20-13-46-Hewa Luce 1 #39 Links.txt';

echo "=== DEBUGGING CASHBOX ZERO VALUES ===\n";

// Create parser and load file
$parser = new Parser();
$parser->load($testFile);

$cashboxData = $parser->getCashboxData();

echo "=== CURRENT CASHBOX DATA ===\n";
print_r($cashboxData);

echo "\n=== RAW CA14 BLOCK ANALYSIS ===\n";
$report = $parser->getReport();
$blocks = $report->getBlocks();

foreach ($blocks as $block) {
    if ($block instanceof \PeanutPay\PhpEvaDts\CoinAcceptedDataBlock) {
        echo "CoinAcceptedDataBlock found:\n";
        echo "  coinValue: " . $block->coinValue . " (raw)\n";
        echo "  amountInLastReset: " . $block->amountInLastReset . "\n";
        echo "  amountInInit: " . $block->amountInInit . "\n";
        echo "  amount2CashboxLastReset: " . $block->amount2CashboxLastReset . "\n";
        echo "  amount2TubeLastReset: " . $block->amount2TubeLastReset . "\n";
        echo "  amount2CashboxInit: " . $block->amount2CashboxInit . "\n";
        echo "  amount2TubeInit: " . $block->amount2TubeInit . "\n";
        
        // Manual calculation
        $amountInit = (int)($block->amountInInit ?? 0);
        $amountReset = (int)($block->amountInLastReset ?? 0);
        
        echo "  amountInit (parsed): $amountInit\n";
        echo "  amountReset (parsed): $amountReset\n";
        
        $totalAccepted = $amountReset >= $amountInit 
            ? $amountReset - $amountInit 
            : $amountInit;
            
        echo "  totalAccepted (calculated): $totalAccepted\n";
        echo "  toString(): " . $block->__toString() . "\n\n";
    }
}

echo "=== RAW CA14 LINES FROM FILE ===\n";
$content = file_get_contents($testFile);
$lines = explode("\n", $content);

foreach ($lines as $lineNum => $line) {
    if (strpos($line, 'CA14*') === 0) {
        echo "Line " . ($lineNum + 1) . ": " . trim($line) . "\n";
        $parts = explode('*', trim($line));
        echo "  Parts: " . implode(' | ', $parts) . "\n";
        if (count($parts) >= 6) {
            echo "  Coin Value: " . $parts[1] . "\n";
            echo "  Field 2: " . $parts[2] . "\n";
            echo "  Field 3: " . $parts[3] . "\n";
            echo "  Field 4: " . $parts[4] . "\n";
            echo "  Field 5: " . $parts[5] . "\n";
        }
        echo "\n";
    }
}
