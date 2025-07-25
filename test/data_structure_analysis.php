<?php
/**
 * Data Structure Analysis Test
 * Analyzes and validates EVA-DTS data structures
 */

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/TestRunner.php';

use PeanutPay\PhpEvaDts\Parser;

$testRunner = new TestRunner();

// Test data structure consistency
$testRunner->addTest(
    'data_structure_consistency',
    function() use ($testRunner) {
        $parser = new Parser();
        $testFile = __DIR__ . '/../example/2024-06-05-15-16-Hewa Snack 138.txt';
        
        if ($parser->load($testFile)) {
            $tables = $parser->getTables();
            
            echo "Data Structure Analysis:\n";
            echo "Number of tables: " . count($tables) . "\n";
            
            $structureValid = true;
            foreach ($tables as $tableName => $tableData) {
                if (!is_array($tableData)) {
                    $structureValid = false;
                    break;
                }
                echo "Table '$tableName': " . count($tableData) . " entries\n";
            }
            
            $testRunner->assertTrue($structureValid, 'All tables should be arrays');
            $testRunner->assertTrue(count($tables) > 0, 'Should have at least one table');
            
            echo "\n";
            $testRunner->trackCoverage('Structure Analysis');
            return true;
        }
        return 'Failed to load test file';
    },
    'Test data structure consistency and validation'
);

// Test table relationships
$testRunner->addTest(
    'table_relationships',
    function() use ($testRunner) {
        $parser = new Parser();
        $testFile = __DIR__ . '/../example/2024-06-05-15-16-Hewa Snack 138.txt';
        
        if ($parser->load($testFile)) {
            $salesData = $parser->getSalesData();
            $productData = $parser->getProductData();
            $cashboxData = $parser->getCashboxData();
            
            echo "Table Relationships Analysis:\n";
            echo "Sales entries: " . count($salesData) . "\n";
            echo "Product entries: " . count($productData) . "\n";
            echo "Cashbox data keys: " . count($cashboxData) . "\n";
            
            // Check if data types are consistent
            $testRunner->assertTrue(is_array($salesData), 'Sales data should be array');
            $testRunner->assertTrue(is_array($productData), 'Product data should be array');
            $testRunner->assertTrue(is_array($cashboxData), 'Cashbox data should be array');
            
            echo "\n";
            $testRunner->trackCoverage('Data Relationships');
            return true;
        }
        return 'Failed to load test file';
    },
    'Test relationships between data tables'
);

// Test data completeness
$testRunner->addTest(
    'data_completeness',
    function() use ($testRunner) {
        $parser = new Parser();
        $testFiles = glob(__DIR__ . '/../example/*.{eva_dts,txt}', GLOB_BRACE);
        
        $completenessStats = [];
        $filesAnalyzed = 0;
        
        foreach (array_slice($testFiles, 0, 3) as $file) { // Limit to 3 files for performance
            if (file_exists($file)) {
                if ($parser->load($file)) {
                    $filesAnalyzed++;
                    
                    $methods = ['getTables', 'getSalesData', 'getProductData', 'getCashboxData'];
                    foreach ($methods as $method) {
                        try {
                            $result = $parser->$method();
                            $completenessStats[$method] = ($completenessStats[$method] ?? 0) + (empty($result) ? 0 : 1);
                        } catch (Exception $e) {
                            // Method failed
                        }
                    }
                }
            }
        }
        
        echo "Data Completeness Analysis:\n";
        echo "Files analyzed: $filesAnalyzed\n";
        foreach ($completenessStats as $method => $successCount) {
            $rate = $filesAnalyzed > 0 ? ($successCount / $filesAnalyzed) * 100 : 0;
            echo "$method: " . number_format($rate, 1) . "% success rate\n";
        }
        
        echo "\n";
        $testRunner->trackCoverage('Data Completeness');
        return true;
    },
    'Test data completeness across multiple files'
);

// Run all tests
$testRunner->run();
