<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/TestRunner.php';

use PeanutPay\PhpEvaDts\Parser;

/**
 * EVA-DTS Field Coverage Test Suite
 * Tests coverage of all 115+ documented field identifiers
 */

$testRunner = new TestRunner();

// Define all known EVA-DTS field identifiers
$expectedFields = [
    // Core Fields
    'ST', 'SE', 'DXS', 'DXE', 'EADXS',
    
    // Machine Info
    'ID1', 'ID4', 'ID5', 'ID6', 'MA5',
    
    // Product Data
    'PA1', 'PA2', 'PA3', 'PA4', 'PA5', 'PA6', 'PA7', 'PA8',
    
    // Vend Data  
    'VA1', 'VA2', 'VA3',
    
    // Price Lists
    'LA1',
    
    // Coin Systems
    'CA1', 'CA2', 'CA3', 'CA4', 'CA5', 'CA6', 'CA7', 'CA8', 'CA9', 'CA10',
    'CA11', 'CA12', 'CA13', 'CA14', 'CA15', 'CA16', 'CA17', 'CA18', 'CA19', 'CA20',
    'CA21', 'CA22', 'CA23', 'CA24',
    
    // Bill Systems
    'BA1', 'BA2', 'BA3', 'BA4',
    
    // Cashless Systems  
    'DA1', 'DA2', 'DA3', 'DA4', 'DA5', 'DA6', 'DA7',
    
    // Events
    'EA1', 'EA2', 'EA3', 'EA4', 'EA5', 'EA6', 'EA7', 'EA250705',
    
    // Audit Data
    'AM1', 'TA1', 'TA2', 'TA3', 'TA4', 'TA5', 'SA1', 'SA2',
    
    // Control & Status
    'CB1', 'G85', 'SD1', 'VM1',
    
    // Database Blocks
    'DB1', 'DB2', 'DB3', 'DB4', 'DB5', 'DB6', 'DB7', 'DB8', 'DB9', 'DB10',
    
    // Position Data
    'PP1'
];

$testRunner->addTest('field_coverage_analysis', function() use ($testRunner, $expectedFields) {
    $testFiles = glob(__DIR__ . '/../example/*.{eva_dts,txt}', GLOB_BRACE);
    $foundFields = [];
    $totalBlocks = 0;
    
    foreach ($testFiles as $file) {
        $parser = new Parser();
        if ($parser->load($file)) {
            $tables = $parser->getTables();
            $totalBlocks += count($tables);
            
            // Extract field identifiers from parsed data
            foreach ($tables as $tableName => $tableData) {
                if (is_array($tableData)) {
                    foreach ($tableData as $row) {
                        if (isset($row['identifier'])) {
                            $foundFields[$row['identifier']] = true;
                        }
                    }
                }
            }
        }
    }
    
    $coveredFields = array_keys($foundFields);
    $coverage = (count($coveredFields) / count($expectedFields)) * 100;
    
    echo "  Field Coverage Analysis:\n";
    echo "  - Expected fields: " . count($expectedFields) . "\n";
    echo "  - Found fields: " . count($coveredFields) . "\n";
    echo "  - Coverage: " . round($coverage, 1) . "%\n";
    echo "  - Total blocks parsed: $totalBlocks\n";
    
    $testRunner->trackCoverage('Field Coverage', count($coveredFields));
    $testRunner->assertTrue($coverage >= 50, "Field coverage should be >= 50%, got {$coverage}%");
    return true;
}, 'Analyze EVA-DTS field identifier coverage');

$testRunner->addTest('datablock_class_coverage', function() use ($testRunner) {
    $srcPath = __DIR__ . '/../src/';
    $dataBlockFiles = glob($srcPath . '*DataBlock.php');
    
    // Count actual DataBlock classes
    $dataBlockCount = 0;
    foreach ($dataBlockFiles as $file) {
        if (basename($file) !== 'DataBlock.php') { // Exclude base class
            $dataBlockCount++;
        }
    }
    
    echo "  DataBlock Class Analysis:\n";
    echo "  - DataBlock classes found: $dataBlockCount\n";
    echo "  - Expected minimum: 80 classes\n";
    
    $testRunner->trackCoverage('DataBlock Classes', $dataBlockCount);
    $testRunner->assertTrue($dataBlockCount >= 80, "Should have at least 80 DataBlock classes, found $dataBlockCount");
    return true;
}, 'Count available DataBlock class implementations');

$testRunner->addTest('data_parsing_quality', function() use ($testRunner) {
    $parser = new Parser();
    $totalDataBlocks = 0;
    $parsedDataBlocks = 0;
    
    $testFiles = glob(__DIR__ . '/../example/*.{eva_dts,txt}', GLOB_BRACE);
    foreach ($testFiles as $file) {
        if ($parser->load($file)) {
            $tables = $parser->getTables();
            foreach ($tables as $tableName => $tableData) {
                $totalDataBlocks++;
                if (!empty($tableData)) {
                    $parsedDataBlocks++;
                }
            }
        }
    }
    
    $parsingQuality = $totalDataBlocks > 0 ? ($parsedDataBlocks / $totalDataBlocks) * 100 : 0;
    
    echo "  Data Parsing Quality:\n";
    echo "  - Total data blocks: $totalDataBlocks\n";
    echo "  - Successfully parsed: $parsedDataBlocks\n";
    echo "  - Parsing quality: " . round($parsingQuality, 1) . "%\n";
    
    $testRunner->trackCoverage('Data Parsing Quality');
    $testRunner->assertTrue($parsingQuality >= 80, "Parsing quality should be >= 80%, got {$parsingQuality}%");
    return true;
}, 'Test data parsing quality and completeness');

$testRunner->addTest('parsing_error_rates', function() use ($testRunner) {
    $parser = new Parser();
    $totalFiles = 0;
    $successfulFiles = 0;
    $totalErrors = 0;
    
    $testFiles = glob(__DIR__ . '/../example/*.{eva_dts,txt}', GLOB_BRACE);
    foreach ($testFiles as $file) {
        $totalFiles++;
        if ($parser->load($file)) {
            $tables = $parser->getTables();
            if (!empty($tables)) {
                $successfulFiles++;
            }
            $errors = $parser->getErrorReport();
            $totalErrors += count($errors);
        }
    }
    
    $successRate = ($successfulFiles / $totalFiles) * 100;
    $errorRate = $totalErrors / $totalFiles;
    
    echo "  Parsing Error Analysis:\n";
    echo "  - Files processed: $totalFiles\n";
    echo "  - Successful parses: $successfulFiles\n";
    echo "  - Success rate: " . round($successRate, 1) . "%\n";
    echo "  - Average errors per file: " . round($errorRate, 2) . "\n";
    
    $testRunner->trackCoverage('Error Handling');
    $testRunner->assertTrue($successRate >= 80, "Success rate should be >= 80%, got {$successRate}%");
    return true;
}, 'Analyze parsing success rates and error frequencies');

$testRunner->addTest('report_generation_coverage', function() use ($testRunner) {
    $parser = new Parser();
    $parser->load(__DIR__ . '/../example/animo.eva_dts');
    
    $methods = [
        'generateSalesReport',
        'generateProductReport', 
        'getErrorReport',
        'getTables',
        'getSalesData',
        'getProductData',
        'getCashboxData',
        'getAuditData',
        'getEventData'
    ];
    
    $workingMethods = 0;
    foreach ($methods as $method) {
        try {
            $result = $parser->$method();
            if ($result !== null) {
                $workingMethods++;
            }
        } catch (Exception $e) {
            // Method failed
        }
    }
    
    $methodCoverage = ($workingMethods / count($methods)) * 100;
    
    echo "  Parser Method Coverage:\n";
    echo "  - Methods tested: " . count($methods) . "\n";
    echo "  - Working methods: $workingMethods\n";
    echo "  - Method coverage: " . round($methodCoverage, 1) . "%\n";
    
    $testRunner->trackCoverage('Parser Methods', $workingMethods);
    $testRunner->assertTrue($methodCoverage >= 90, "Method coverage should be >= 90%, got {$methodCoverage}%");
    return true;
}, 'Test all parser method implementations');

// Run field coverage tests
echo "Starting EVA-DTS Field Coverage Test Suite...\n";
echo "Analyzing " . count($expectedFields) . " expected field identifiers...\n";

$testRunner->run();
