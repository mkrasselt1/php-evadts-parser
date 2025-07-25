<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

// Test file
$testFile = __DIR__ . '/../example/2025-06-20-13-46-Hewa Luce 1 #39 Links.txt';

echo "=== EVA-DTS PARSER FUNCTIONALITY TEST ===\n";
echo "Test file: " . basename($testFile) . "\n";
echo "File exists: " . (file_exists($testFile) ? 'YES' : 'NO') . "\n";
echo "File size: " . filesize($testFile) . " bytes\n\n";

// Create parser and load file
$parser = new Parser();

echo "=== LOADING FILE ===\n";
if ($parser->load($testFile)) {
    echo "✅ File loaded successfully\n\n";
} else {
    echo "❌ Failed to load file\n";
    exit(1);
}

// Test core parser methods
$methods = [
    'getTables',
    'getSalesData', 
    'getProductData',
    'getCashboxData',
    'getAuditData',
    'getEventData',
    'generateSalesReport',
    'generateProductReport',
    'getErrorReport'
];

foreach ($methods as $method) {
    echo "=== TESTING: $method() ===\n";
    try {
        $start = microtime(true);
        $result = $parser->$method();
        $duration = round((microtime(true) - $start) * 1000, 2);
        
        echo "✅ SUCCESS - Duration: {$duration}ms\n";
        echo "Result type: " . gettype($result) . "\n";
        
        if (is_array($result)) {
            echo "Array size: " . count($result) . " items\n";
            if (!empty($result)) {
                echo "Top-level keys: " . implode(', ', array_keys($result)) . "\n";
            }
        }
        
    } catch (Exception $e) {
        echo "❌ ERROR: " . $e->getMessage() . "\n";
        echo "File: " . $e->getFile() . "\n";
        echo "Line: " . $e->getLine() . "\n";
    }
    echo "\n";
}

echo "=== DATA BLOCK ANALYSIS ===\n";
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
        
        echo "Block types found: " . count($blockTypes) . "\n";
        echo "Most common blocks:\n";
        arsort($blockTypes);
        $top5 = array_slice($blockTypes, 0, 5, true);
        foreach ($top5 as $type => $count) {
            echo "  $type: $count\n";
        }
    }
} catch (Exception $e) {
    echo "❌ Block analysis ERROR: " . $e->getMessage() . "\n";
}

echo "\n=== TEST COMPLETED ===\n";
