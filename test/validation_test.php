<?php
/**
 * Validation Test
 * General validation test for EVA-DTS parser functionality
 */

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/TestRunner.php';

use PeanutPay\PhpEvaDts\Parser;

$testRunner = new TestRunner();

// Basic validation test
$testRunner->addTest(
    'basic_validation',
    function() use ($testRunner) {
        $parser = new Parser();
        $testRunner->assertInstanceOf('PeanutPay\PhpEvaDts\Parser', $parser);
        $testRunner->trackCoverage('Basic Validation');
        return true;
    },
    'Basic parser instantiation validation'
);

// File format validation
$testRunner->addTest(
    'file_format_validation',
    function() use ($testRunner) {
        $formats = [
            '.eva_dts' => __DIR__ . '/../example/animo.eva_dts',
            '.txt' => __DIR__ . '/../example/2024-06-05-15-16-Hewa Snack 138.txt'
        ];
        
        $supportedFormats = 0;
        
        foreach ($formats as $format => $file) {
            if (file_exists($file)) {
                $parser = new Parser();
                if ($parser->load($file)) {
                    $supportedFormats++;
                    echo "✅ $format format supported\n";
                } else {
                    echo "❌ $format format failed\n";
                }
            }
        }
        
        $testRunner->assertTrue($supportedFormats >= 1, 'Should support at least one file format');
        $testRunner->trackCoverage('Format Support');
        return true;
    },
    'Validate support for different file formats'
);

// Data integrity validation
$testRunner->addTest(
    'data_integrity_validation',
    function() use ($testRunner) {
        $parser = new Parser();
        $testFile = __DIR__ . '/../example/animo.eva_dts';
        
        if (file_exists($testFile) && $parser->load($testFile)) {
            $tables = $parser->getTables();
            $salesData = $parser->getSalesData();
            $productData = $parser->getProductData();
            
            // Validate data types
            $testRunner->assertTrue(is_array($tables), 'Tables should be array');
            $testRunner->assertTrue(is_array($salesData), 'Sales data should be array');
            $testRunner->assertTrue(is_array($productData), 'Product data should be array');
            
            // Check for basic data integrity
            if (!empty($tables)) {
                echo "✅ Data tables generated successfully\n";
            }
            if (!empty($salesData)) {
                echo "✅ Sales data extracted successfully\n";
            }
            if (!empty($productData)) {
                echo "✅ Product data extracted successfully\n";
            }
            
            $testRunner->trackCoverage('Data Integrity');
            return true;
        }
        
        return 'Test file not available or failed to load';
    },
    'Validate data integrity and consistency'
);

// Error handling validation
$testRunner->addTest(
    'error_handling_validation',
    function() use ($testRunner) {
        $parser = new Parser();
        
        // Test with non-existent file
        $result = $parser->load('/nonexistent/path/file.eva');
        $testRunner->assertTrue($result === false, 'Should handle non-existent files gracefully');
        
        // Test with empty string
        $result = $parser->load('');
        $testRunner->assertTrue($result === false, 'Should handle empty paths gracefully');
        
        echo "✅ Error handling works correctly\n";
        $testRunner->trackCoverage('Error Handling');
        return true;
    },
    'Validate error handling mechanisms'
);

// Performance validation
$testRunner->addTest(
    'performance_validation',
    function() use ($testRunner) {
        $parser = new Parser();
        $testFile = __DIR__ . '/../example/2024-06-05-15-16-Hewa Snack 138.txt';
        
        if (file_exists($testFile)) {
            $start = microtime(true);
            $result = $parser->load($testFile);
            $loadTime = microtime(true) - $start;
            
            if ($result) {
                $start = microtime(true);
                $tables = $parser->getTables();
                $parseTime = microtime(true) - $start;
                
                echo "Performance metrics:\n";
                echo "  Load time: " . number_format($loadTime * 1000, 2) . "ms\n";
                echo "  Parse time: " . number_format($parseTime * 1000, 2) . "ms\n";
                
                $testRunner->assertTrue($loadTime < 1.0, 'Load time should be under 1 second');
                $testRunner->assertTrue($parseTime < 0.5, 'Parse time should be under 0.5 seconds');
            }
            
            $testRunner->trackCoverage('Performance');
            return true;
        }
        
        return 'Test file not available';
    },
    'Validate parsing performance'
);

// Run all tests
$testRunner->run();
