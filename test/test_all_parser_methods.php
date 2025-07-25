<?php
/**
 * Test All Parser Methods
 * Comprehensive test of all available parser methods
 */

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/TestRunner.php';

use PeanutPay\PhpEvaDts\Parser;

$testRunner = new TestRunner();

$testFile = __DIR__ . '/../example/2024-06-05-15-16-Hewa Snack 138.txt';

// Test all core parser methods
$methods = [
    'getTables' => 'Get all organized data tables',
    'getSalesData' => 'Extract sales transaction data',
    'getProductData' => 'Get product information and statistics',
    'getCashboxData' => 'Extract cashbox and payment data',
    'getAuditData' => 'Get audit trail and system logs',
    'getEventData' => 'Extract event and error logs',
    'generateSalesReport' => 'Generate comprehensive sales analysis',
    'generateProductReport' => 'Generate product performance report',
    'getErrorReport' => 'Get data validation and error report'
];

foreach ($methods as $method => $description) {
    $testRunner->addTest(
        "method_$method",
        function() use ($method, $testFile, $testRunner) {
            $parser = new Parser();
            if ($parser->load($testFile)) {
                $result = $parser->$method();
                $testRunner->assertTrue(
                    is_array($result), 
                    "Method $method should return array data"
                );
                $testRunner->trackCoverage('Parser Methods');
                return true;
            }
            return "Failed to load test file for $method";
        },
        "Test $method() - $description"
    );
}

// Test method chaining
$testRunner->addTest(
    'method_chaining',
    function() use ($testFile, $testRunner) {
        $parser = new Parser();
        if ($parser->load($testFile)) {
            // Test that methods can be called in sequence
            $tables = $parser->getTables();
            $sales = $parser->getSalesData();
            $products = $parser->getProductData();
            
            $testRunner->assertTrue(is_array($tables), 'getTables should work in chain');
            $testRunner->assertTrue(is_array($sales), 'getSalesData should work in chain');
            $testRunner->assertTrue(is_array($products), 'getProductData should work in chain');
            $testRunner->trackCoverage('Method Chaining');
            return true;
        }
        return 'Failed to load test file';
    },
    'Test method chaining and sequential calls'
);

// Test performance with large files
$testRunner->addTest(
    'performance_large_file',
    function() use ($testRunner) {
        $parser = new Parser();
        $largeFile = __DIR__ . '/../example/2025-07-07-10-05-Hewa Snack 1#38.txt';
        
        if (file_exists($largeFile)) {
            $start = microtime(true);
            $result = $parser->load($largeFile);
            $duration = microtime(true) - $start;
            
            $testRunner->assertTrue($result, 'Should load large file');
            $testRunner->assertTrue($duration < 5.0, 'Should load in under 5 seconds');
            $testRunner->trackCoverage('Performance');
            return true;
        }
        
        // If large file doesn't exist, test with available file
        if ($parser->load(__DIR__ . '/../example/2024-06-05-15-16-Hewa Snack 138.txt')) {
            $testRunner->trackCoverage('Performance');
            return true;
        }
        return 'No suitable test file found';
    },
    'Test parsing performance with larger files'
);

// Run all tests
$testRunner->run();
