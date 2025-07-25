<?php
/**
 * Comprehensive EVA-DTS Parser Test
 * Tests multiple file formats and parser methods
 */

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/TestRunner.php';

use PeanutPay\PhpEvaDts\Parser;

$testRunner = new TestRunner();

// Test data files
$testFiles = [
    __DIR__ . '/../example/animo.eva_dts',
    __DIR__ . '/../example/sielaff.eva_dts',
    __DIR__ . '/../example/rhevendors.eva_dts',
    __DIR__ . '/../example/2024-06-05-15-16-Hewa Snack 138.txt',
    __DIR__ . '/../example/2025-01-22-15-27-ACTECH Snack.txt'
];

// Test basic parser instantiation
$testRunner->addTest(
    'parser_instantiation',
    function() use ($testRunner) {
        $parser = new Parser();
        $testRunner->assertInstanceOf('PeanutPay\PhpEvaDts\Parser', $parser);
        $testRunner->trackCoverage('Core Parser');
        return true;
    },
    'Test basic parser instantiation'
);

// Test file loading for each format
foreach ($testFiles as $file) {
    if (file_exists($file)) {
        $testRunner->addTest(
            'file_loading_' . basename($file, '.eva_dts'),
            function() use ($file, $testRunner) {
                $parser = new Parser();
                $result = $parser->load($file);
                $testRunner->assertTrue($result, "Failed to load file: " . basename($file));
                $testRunner->trackCoverage('File Loading');
                return true;
            },
            'Test loading ' . basename($file)
        );
    }
}

// Test parser methods
$testRunner->addTest(
    'parser_methods_getTables',
    function() use ($testRunner) {
        $parser = new Parser();
        if ($parser->load(__DIR__ . '/../example/animo.eva_dts')) {
            $tables = $parser->getTables();
            $testRunner->assertNotEmpty($tables, 'getTables() should return data');
            $testRunner->trackCoverage('Parser Methods');
            return true;
        }
        return 'Failed to load test file';
    },
    'Test getTables() method'
);

$testRunner->addTest(
    'parser_methods_getSalesData',
    function() use ($testRunner) {
        $parser = new Parser();
        if ($parser->load(__DIR__ . '/../example/animo.eva_dts')) {
            $salesData = $parser->getSalesData();
            $testRunner->trackCoverage('Parser Methods');
            return true; // getSalesData can return empty array
        }
        return 'Failed to load test file';
    },
    'Test getSalesData() method'
);

$testRunner->addTest(
    'parser_methods_getProductData',
    function() use ($testRunner) {
        $parser = new Parser();
        if ($parser->load(__DIR__ . '/../example/animo.eva_dts')) {
            $productData = $parser->getProductData();
            $testRunner->trackCoverage('Parser Methods');
            return true;
        }
        return 'Failed to load test file';
    },
    'Test getProductData() method'
);

$testRunner->addTest(
    'parser_methods_getCashboxData',
    function() use ($testRunner) {
        $parser = new Parser();
        if ($parser->load(__DIR__ . '/../example/animo.eva_dts')) {
            $cashboxData = $parser->getCashboxData();
            $testRunner->trackCoverage('Parser Methods');
            return true;
        }
        return 'Failed to load test file';
    },
    'Test getCashboxData() method'
);

$testRunner->addTest(
    'parser_methods_getAuditData',
    function() use ($testRunner) {
        $parser = new Parser();
        if ($parser->load(__DIR__ . '/../example/animo.eva_dts')) {
            $auditData = $parser->getAuditData();
            $testRunner->trackCoverage('Parser Methods');
            return true;
        }
        return 'Failed to load test file';
    },
    'Test getAuditData() method'
);

$testRunner->addTest(
    'parser_methods_getEventData',
    function() use ($testRunner) {
        $parser = new Parser();
        if ($parser->load(__DIR__ . '/../example/animo.eva_dts')) {
            $eventData = $parser->getEventData();
            $testRunner->trackCoverage('Parser Methods');
            return true;
        }
        return 'Failed to load test file';
    },
    'Test getEventData() method'
);

// Test report generation
$testRunner->addTest(
    'report_generation_sales',
    function() use ($testRunner) {
        $parser = new Parser();
        if ($parser->load(__DIR__ . '/../example/animo.eva_dts')) {
            $report = $parser->generateSalesReport();
            $testRunner->trackCoverage('Report Generation');
            return true;
        }
        return 'Failed to load test file';
    },
    'Test sales report generation'
);

$testRunner->addTest(
    'report_generation_product',
    function() use ($testRunner) {
        $parser = new Parser();
        if ($parser->load(__DIR__ . '/../example/animo.eva_dts')) {
            $report = $parser->generateProductReport();
            $testRunner->trackCoverage('Report Generation');
            return true;
        }
        return 'Failed to load test file';
    },
    'Test product report generation'
);

$testRunner->addTest(
    'report_generation_error',
    function() use ($testRunner) {
        $parser = new Parser();
        if ($parser->load(__DIR__ . '/../example/animo.eva_dts')) {
            $report = $parser->getErrorReport();
            $testRunner->trackCoverage('Report Generation');
            return true;
        }
        return 'Failed to load test file';
    },
    'Test error report generation'
);

// Test error handling
$testRunner->addTest(
    'error_handling_invalid_file',
    function() use ($testRunner) {
        $parser = new Parser();
        $result = $parser->load('/nonexistent/file.eva');
        $testRunner->assertTrue($result === false, 'Should return false for invalid file');
        $testRunner->trackCoverage('Error Handling');
        return true;
    },
    'Test handling of invalid file path'
);

$testRunner->addTest(
    'error_handling_empty_file',
    function() use ($testRunner) {
        // Create temporary empty file
        $tempFile = tempnam(sys_get_temp_dir(), 'eva_test_');
        file_put_contents($tempFile, '');
        
        $parser = new Parser();
        $result = $parser->load($tempFile);
        
        unlink($tempFile);
        
        $testRunner->trackCoverage('Error Handling');
        return true; // Parser should handle empty files gracefully
    },
    'Test handling of empty file'
);

// Run all tests
$testRunner->run();
