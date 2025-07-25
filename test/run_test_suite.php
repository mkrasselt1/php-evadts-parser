<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/TestRunner.php';

use PeanutPay\PhpEvaDts\Parser;

/**
 * Comprehensive EVA-DTS Parser Test Suite
 * PHPUnit-style testing with detailed reporting
 */

$testRunner = new TestRunner();

// Core Parser Tests
$testRunner->addTest('parser_initialization', function() use ($testRunner) {
    $parser = new Parser();
    $testRunner->assertInstanceOf(Parser::class, $parser, 'Parser should be instantiated');
    $testRunner->trackCoverage('Core Parser');
    return true;
}, 'Test basic parser instantiation');

$testRunner->addTest('file_loading_animo', function() use ($testRunner) {
    $parser = new Parser();
    $result = $parser->load(__DIR__ . '/../example/animo.eva_dts');
    $testRunner->assertTrue($result, 'Should load animo.eva_dts file');
    $testRunner->trackCoverage('File Loading');
    return true;
}, 'Test loading Animo EVA-DTS file');

$testRunner->addTest('file_loading_sielaff', function() use ($testRunner) {
    $parser = new Parser();
    $result = $parser->load(__DIR__ . '/../example/sielaff.eva_dts');
    $testRunner->assertTrue($result, 'Should load sielaff.eva_dts file');
    $testRunner->trackCoverage('File Loading');
    return true;
}, 'Test loading Sielaff EVA-DTS file');

$testRunner->addTest('file_loading_rhevendors', function() use ($testRunner) {
    $parser = new Parser();
    $result = $parser->load(__DIR__ . '/../example/rhevendors.eva_dts');
    $testRunner->assertTrue($result, 'Should load rhevendors.eva_dts file');
    $testRunner->trackCoverage('File Loading');
    return true;
}, 'Test loading Rhevendors EVA-DTS file');

// Parser Method Tests
$testRunner->addTest('get_tables_method', function() use ($testRunner) {
    $parser = new Parser();
    $parser->load(__DIR__ . '/../example/animo.eva_dts');
    $tables = $parser->getTables();
    $testRunner->assertNotEmpty($tables, 'getTables should return data');
    $testRunner->assertTrue(is_array($tables), 'getTables should return array');
    $testRunner->trackCoverage('Parser Methods');
    return true;
}, 'Test getTables() parser method');

$testRunner->addTest('get_sales_data_method', function() use ($testRunner) {
    $parser = new Parser();
    $parser->load(__DIR__ . '/../example/animo.eva_dts');
    $salesData = $parser->getSalesData();
    $testRunner->assertTrue(is_array($salesData), 'getSalesData should return array');
    $testRunner->trackCoverage('Parser Methods');
    return true;
}, 'Test getSalesData() parser method');

$testRunner->addTest('get_product_data_method', function() use ($testRunner) {
    $parser = new Parser();
    $parser->load(__DIR__ . '/../example/animo.eva_dts');
    $productData = $parser->getProductData();
    $testRunner->assertTrue(is_array($productData), 'getProductData should return array');
    $testRunner->trackCoverage('Parser Methods');
    return true;
}, 'Test getProductData() parser method');

$testRunner->addTest('get_cashbox_data_method', function() use ($testRunner) {
    $parser = new Parser();
    $parser->load(__DIR__ . '/../example/animo.eva_dts');
    $cashboxData = $parser->getCashboxData();
    $testRunner->assertTrue(is_array($cashboxData), 'getCashboxData should return array');
    $testRunner->trackCoverage('Parser Methods');
    return true;
}, 'Test getCashboxData() parser method');

$testRunner->addTest('get_audit_data_method', function() use ($testRunner) {
    $parser = new Parser();
    $parser->load(__DIR__ . '/../example/animo.eva_dts');
    $auditData = $parser->getAuditData();
    $testRunner->assertTrue(is_array($auditData), 'getAuditData should return array');
    $testRunner->trackCoverage('Parser Methods');
    return true;
}, 'Test getAuditData() parser method');

$testRunner->addTest('get_event_data_method', function() use ($testRunner) {
    $parser = new Parser();
    $parser->load(__DIR__ . '/../example/animo.eva_dts');
    $eventData = $parser->getEventData();
    $testRunner->assertTrue(is_array($eventData), 'getEventData should return array');
    $testRunner->trackCoverage('Parser Methods');
    return true;
}, 'Test getEventData() parser method');

// Report Generation Tests
$testRunner->addTest('generate_sales_report', function() use ($testRunner) {
    $parser = new Parser();
    $parser->load(__DIR__ . '/../example/animo.eva_dts');
    $report = $parser->generateSalesReport();
    $testRunner->assertNotEmpty($report, 'generateSalesReport should return data');
    $testRunner->trackCoverage('Report Generation');
    return true;
}, 'Test sales report generation');

$testRunner->addTest('generate_product_report', function() use ($testRunner) {
    $parser = new Parser();
    $parser->load(__DIR__ . '/../example/animo.eva_dts');
    $report = $parser->generateProductReport();
    $testRunner->assertNotEmpty($report, 'generateProductReport should return data');
    $testRunner->trackCoverage('Report Generation');
    return true;
}, 'Test product report generation');

$testRunner->addTest('get_error_report', function() use ($testRunner) {
    $parser = new Parser();
    $parser->load(__DIR__ . '/../example/animo.eva_dts');
    $errors = $parser->getErrorReport();
    $testRunner->assertTrue(is_array($errors), 'getErrorReport should return array');
    $testRunner->trackCoverage('Error Handling');
    return true;
}, 'Test error report generation');

// Data Block Coverage Tests
$testRunner->addTest('datablock_coverage_validation', function() use ($testRunner) {
    $parser = new Parser();
    $parser->load(__DIR__ . '/../example/animo.eva_dts');
    $tables = $parser->getTables();
    
    // Check for any valid data tables
    $foundValidTables = 0;
    foreach ($tables as $tableName => $tableData) {
        if (!empty($tableData) && is_array($tableData)) {
            $foundValidTables++;
        }
    }
    
    $testRunner->assertTrue($foundValidTables >= 3, "Should find at least 3 valid data tables, found {$foundValidTables}");
    $testRunner->trackCoverage('DataBlock Coverage');
    return true;
}, 'Test DataBlock type coverage validation');

// Multi-file validation test
$testRunner->addTest('multi_file_validation', function() use ($testRunner) {
    $testFiles = [
        'animo.eva_dts',
        'sielaff.eva_dts', 
        'rhevendors.eva_dts'
    ];
    
    $successfulParsing = 0;
    foreach ($testFiles as $file) {
        $parser = new Parser();
        if ($parser->load(__DIR__ . "/../example/$file")) {
            $tables = $parser->getTables();
            if (!empty($tables)) {
                $successfulParsing++;
            }
        }
    }
    
    $testRunner->assertTrue($successfulParsing >= 2, "Should successfully parse at least 2 out of 3 test files");
    $testRunner->trackCoverage('Multi-file Support');
    return true;
}, 'Test parsing multiple file formats');

// Text format files test (Hewa, ACTECH)
$testRunner->addTest('text_format_files', function() use ($testRunner) {
    $textFiles = glob(__DIR__ . '/../example/*.txt');
    $parsedFiles = 0;
    
    foreach ($textFiles as $file) {
        $parser = new Parser();
        if ($parser->load($file)) {
            $tables = $parser->getTables();
            if (!empty($tables)) {
                $parsedFiles++;
            }
        }
    }
    
    $testRunner->assertTrue($parsedFiles > 0, "Should successfully parse at least one .txt format file");
    $testRunner->trackCoverage('Text Format Support');
    return true;
}, 'Test parsing .txt format EVA files');

// Performance test
$testRunner->addTest('parsing_performance', function() use ($testRunner) {
    $parser = new Parser();
    $startTime = microtime(true);
    $parser->load(__DIR__ . '/../example/animo.eva_dts');
    $tables = $parser->getTables();
    $duration = microtime(true) - $startTime;
    
    $testRunner->assertTrue($duration < 5.0, "Parsing should complete within 5 seconds, took {$duration}s");
    $testRunner->trackCoverage('Performance');
    return true;
}, 'Test parsing performance');

// Data integrity test
$testRunner->addTest('data_integrity_validation', function() use ($testRunner) {
    $parser = new Parser();
    $parser->load(__DIR__ . '/../example/animo.eva_dts');
    
    $salesData = $parser->getSalesData();
    $productData = $parser->getProductData();
    
    // Check for data consistency
    $hasValidSalesData = !empty($salesData) && is_array($salesData);
    $hasValidProductData = !empty($productData) && is_array($productData);
    
    $testRunner->assertTrue($hasValidSalesData || $hasValidProductData, 
        "Should have valid sales or product data");
    $testRunner->trackCoverage('Data Integrity');
    return true;
}, 'Test data integrity and consistency');

// Run all tests
echo "Starting EVA-DTS Parser Test Suite...\n";
echo "Test files directory: " . __DIR__ . "/../example/\n";

$testRunner->run();
