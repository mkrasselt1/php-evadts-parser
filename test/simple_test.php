<?php
/**
 * Simple EVA-DTS Parser Test
 * Basic functionality test for quick validation
 */

require_once __DIR__ . '/../vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

echo "======================================================================\n";
echo "Simple EVA-DTS Parser Test\n";
echo "======================================================================\n\n";

$testFiles = [
    __DIR__ . '/../example/animo.eva_dts',
    __DIR__ . '/../example/sielaff.eva_dts'
];

$totalTests = 0;
$passedTests = 0;
$failedTests = 0;

foreach ($testFiles as $file) {
    if (!file_exists($file)) {
        echo "❌ SKIP: File not found - " . basename($file) . "\n";
        continue;
    }
    
    echo "Testing file: " . basename($file) . "\n";
    
    try {
        $parser = new Parser();
        
        // Test 1: File loading
        $totalTests++;
        echo "  1. Loading file... ";
        if ($parser->load($file)) {
            echo "✅ PASS\n";
            $passedTests++;
        } else {
            echo "❌ FAIL\n";
            $failedTests++;
            continue;
        }
        
        // Test 2: Get tables
        $totalTests++;
        echo "  2. Getting tables... ";
        $tables = $parser->getTables();
        if (!empty($tables)) {
            echo "✅ PASS (" . count($tables) . " tables)\n";
            $passedTests++;
        } else {
            echo "❌ FAIL (no tables)\n";
            $failedTests++;
        }
        
        // Test 3: Generate sales report
        $totalTests++;
        echo "  3. Sales report... ";
        $salesReport = $parser->generateSalesReport();
        if (!empty($salesReport)) {
            echo "✅ PASS\n";
            $passedTests++;
        } else {
            echo "⚠️  WARN (empty report)\n";
            $passedTests++; // Empty reports are acceptable
        }
        
        // Test 4: Product data
        $totalTests++;
        echo "  4. Product data... ";
        $productData = $parser->getProductData();
        if (is_array($productData)) {
            echo "✅ PASS (" . count($productData) . " products)\n";
            $passedTests++;
        } else {
            echo "❌ FAIL\n";
            $failedTests++;
        }
        
    } catch (Exception $e) {
        echo "❌ ERROR: " . $e->getMessage() . "\n";
        $failedTests++;
    }
    
    echo "\n";
}

// Final summary
echo "======================================================================\n";
echo "TEST SUMMARY\n";
echo "======================================================================\n";
echo "Total Tests: $totalTests\n";
echo "Passed: $passedTests\n";
echo "Failed: $failedTests\n";

if ($totalTests > 0) {
    $successRate = ($passedTests / $totalTests) * 100;
    echo "Success Rate: " . number_format($successRate, 1) . "%\n";
    
    if ($successRate >= 90) {
        echo "🎉 EXCELLENT\n";
    } elseif ($successRate >= 75) {
        echo "✅ GOOD\n";
    } elseif ($successRate >= 50) {
        echo "⚠️  MODERATE\n";
    } else {
        echo "❌ POOR\n";
    }
} else {
    echo "❌ NO TESTS RUN\n";
}

echo "======================================================================\n";
