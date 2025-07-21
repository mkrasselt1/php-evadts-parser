<?php

require_once __DIR__ . '/vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

// Test file
$testFile = __DIR__ . '/example/2025-06-20-13-46-Hewa Luce 1 #39 Links.txt';

echo "=== TESTING ALL PARSER REPORTS ===\n";
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

// Test each method individually
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
                
                // Show sample data for first few items
                if ($method === 'getSalesData' && isset($result[0])) {
                    echo "Sample sales record: " . json_encode($result[0], JSON_PRETTY_PRINT) . "\n";
                } elseif ($method === 'getProductData' && isset($result[0])) {
                    echo "Sample product: " . json_encode($result[0], JSON_PRETTY_PRINT) . "\n";
                } elseif ($method === 'getCashboxData') {
                    echo "Cashbox totals: " . json_encode($result['totals'] ?? [], JSON_PRETTY_PRINT) . "\n";
                } elseif ($method === 'generateSalesReport') {
                    echo "Sales summary: " . json_encode($result['summary'] ?? [], JSON_PRETTY_PRINT) . "\n";
                }
            }
        }
        
    } catch (Exception $e) {
        echo "❌ ERROR: " . $e->getMessage() . "\n";
        echo "File: " . $e->getFile() . "\n";
        echo "Line: " . $e->getLine() . "\n";
        echo "Trace: " . $e->getTraceAsString() . "\n";
    }
    echo "\n";
}

// Test getTables() comprehensive output
echo "=== COMPREHENSIVE getTables() OUTPUT ===\n";
try {
    $tables = $parser->getTables();
    
    foreach ($tables as $tableName => $tableData) {
        echo "Table: $tableName\n";
        if (is_array($tableData)) {
            echo "  Size: " . count($tableData) . " items\n";
            if (!empty($tableData)) {
                if (isset($tableData[0]) && is_array($tableData[0])) {
                    echo "  Sample keys: " . implode(', ', array_keys($tableData[0])) . "\n";
                } else {
                    echo "  Top-level keys: " . implode(', ', array_keys($tableData)) . "\n";
                }
            }
        }
        echo "\n";
    }
    
} catch (Exception $e) {
    echo "❌ getTables() ERROR: " . $e->getMessage() . "\n";
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
        
        echo "Block types found:\n";
        foreach ($blockTypes as $type => $count) {
            echo "  $type: $count\n";
        }
    }
} catch (Exception $e) {
    echo "❌ Block analysis ERROR: " . $e->getMessage() . "\n";
}

echo "\n=== TEST COMPLETED ===\n";
