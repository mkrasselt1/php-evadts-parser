<?php
/**
 * Legacy Compatibility Test
 * Tests backward compatibility with older EVA-DTS formats and parser methods
 */

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/TestRunner.php';

use PeanutPay\PhpEvaDts\Parser;

$testRunner = new TestRunner();

// Test legacy file formats
$testRunner->addTest(
    'legacy_eva_dts_format',
    function() use ($testRunner) {
        $parser = new Parser();
        $result = $parser->load(__DIR__ . '/../example/animo.eva_dts');
        $testRunner->assertTrue($result, 'Should load legacy .eva_dts format');
        $testRunner->trackCoverage('Legacy Compatibility');
        return true;
    },
    'Test legacy .eva_dts file format compatibility'
);

// Test legacy parser methods
$testRunner->addTest(
    'legacy_getReport_method',
    function() use ($testRunner) {
        $parser = new Parser();
        if ($parser->load(__DIR__ . '/../example/animo.eva_dts')) {
            $report = $parser->getReport();
            $testRunner->assertNotEmpty($report, 'Legacy getReport() should return data');
            $testRunner->trackCoverage('Legacy Methods');
            return true;
        }
        return 'Failed to load test file';
    },
    'Test legacy getReport() method'
);

// Test legacy product report format
$testRunner->addTest(
    'legacy_product_report_format',
    function() use ($testRunner) {
        $parser = new Parser();
        if ($parser->load(__DIR__ . '/../example/animo.eva_dts')) {
            $legacyReport = $parser->getProductReportLegacy();
            $testRunner->trackCoverage('Legacy Formats');
            return true; // Legacy format can be empty
        }
        return 'Failed to load test file';
    },
    'Test legacy product report format compatibility'
);

// Test backward compatibility with old data structures
$testRunner->addTest(
    'backward_compatibility_data_structures',
    function() use ($testRunner) {
        $parser = new Parser();
        if ($parser->load(__DIR__ . '/../example/rhevendors.eva_dts')) {
            // Test that old data structures still work
            $tables = $parser->getTables();
            $testRunner->assertNotEmpty($tables, 'Should handle legacy data structures');
            $testRunner->trackCoverage('Data Structures');
            return true;
        }
        return 'Failed to load test file';
    },
    'Test backward compatibility with legacy data structures'
);

// Test legacy error handling
$testRunner->addTest(
    'legacy_error_handling',
    function() use ($testRunner) {
        $parser = new Parser();
        // Test with potentially problematic legacy file
        if ($parser->load(__DIR__ . '/../example/sielaff.eva_dts')) {
            $errorReport = $parser->getErrorReport();
            $testRunner->assertTrue(is_array($errorReport), 'Error handling should work with legacy files');
            $testRunner->trackCoverage('Error Handling');
            return true;
        }
        return 'Failed to load test file';
    },
    'Test legacy error handling mechanisms'
);

// Run all tests
$testRunner->run();
