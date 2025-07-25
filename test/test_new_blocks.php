<?php

require_once __DIR__ . '/vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

echo "=== TESTING NEW DATABLOCK CLASSES ===\n";

// Test file with the previously unknown blocks
$testFile = __DIR__ . '/test_unknown_blocks.eva';

echo "Test file: " . basename($testFile) . "\n";
echo "File exists: " . (file_exists($testFile) ? 'YES' : 'NO') . "\n\n";

// Create parser and load file
$parser = new Parser();

echo "=== LOADING TEST FILE ===\n";
if ($parser->load($testFile)) {
    echo "✅ File loaded successfully\n\n";
} else {
    echo "❌ Failed to load file\n";
    exit(1);
}

echo "=== ANALYZING DATA BLOCKS ===\n";
try {
    $report = $parser->getReport();
    if ($report) {
        $blocks = $report->getBlocks();
        echo "Total data blocks: " . count($blocks) . "\n";
        
        $blockTypes = [];
        foreach ($blocks as $block) {
            $className = get_class($block);
            $shortName = str_replace('PeanutPay\\PhpEvaDts\\', '', $className);
            $blockTypes[$shortName] = ($blockTypes[$shortName] ?? 0) + 1;
        }
        
        echo "Block types found:\n";
        foreach ($blockTypes as $type => $count) {
            echo "  $type: $count\n";
        }
        
        // Check specifically for our new blocks
        echo "\n=== NEW DATABLOCK VERIFICATION ===\n";
        $foundNewBlocks = false;
        
        foreach ($blocks as $block) {
            if ($block instanceof \PeanutPay\PhpEvaDts\DA7DataBlock) {
                echo "✅ DA7DataBlock found: Device #{$block->deviceNumber}, Value: {$block->transactionValue}\n";
                $foundNewBlocks = true;
            }
            if ($block instanceof \PeanutPay\PhpEvaDts\EA250705DataBlock) {
                echo "✅ EA250705DataBlock found: Event Code: {$block->eventCode}\n";
                $foundNewBlocks = true;
            }
            if ($block instanceof \PeanutPay\PhpEvaDts\EADXSDataBlock) {
                echo "✅ EADXSDataBlock found: System ID: {$block->systemId}\n";
                $foundNewBlocks = true;
            }
        }
        
        if (!$foundNewBlocks) {
            echo "ℹ️  No instances of the new DataBlock classes found in this file\n";
        }
    }
} catch (Exception $e) {
    echo "❌ Block analysis ERROR: " . $e->getMessage() . "\n";
}

echo "\n=== TEST COMPLETED ===\n";

// Clean up test file
unlink($testFile);
