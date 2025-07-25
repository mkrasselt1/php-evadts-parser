<?php
/**
 * Validate All Files Test
 * Tests parsing of all available EVA-DTS files
 */

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/TestRunner.php';

use PeanutPay\PhpEvaDts\Parser;

$testRunner = new TestRunner();

// Get all EVA-DTS files
$evaFiles = array_merge(
    glob(__DIR__ . '/../example/*.eva_dts'),
    glob(__DIR__ . '/../example/*.txt')
);

echo "Found " . count($evaFiles) . " EVA-DTS files to validate\n\n";

// Test each file individually
foreach ($evaFiles as $file) {
    $filename = basename($file);
    
    $testRunner->addTest(
        "validate_$filename",
        function() use ($file, $testRunner) {
            if (!file_exists($file)) {
                return "File not found: " . basename($file);
            }
            
            $parser = new Parser();
            $result = $parser->load($file);
            
            if ($result) {
                // Additional validation checks
                $tables = $parser->getTables();
                $testRunner->assertTrue(is_array($tables), 'Should return array of tables');
                
                // Check if we can generate reports without errors
                try {
                    $salesReport = $parser->generateSalesReport();
                    $productReport = $parser->generateProductReport();
                    $errorReport = $parser->getErrorReport();
                    
                    $testRunner->assertTrue(is_array($salesReport), 'Sales report should be array');
                    $testRunner->assertTrue(is_array($productReport), 'Product report should be array');
                    $testRunner->assertTrue(is_array($errorReport), 'Error report should be array');
                    
                } catch (Exception $e) {
                    return "Report generation failed: " . $e->getMessage();
                }
                
                $testRunner->trackCoverage('File Validation');
                return true;
            } else {
                return "Failed to load file: " . basename($file);
            }
        },
        "Validate parsing of $filename"
    );
}

// Summary test
$testRunner->addTest(
    'validation_summary',
    function() use ($evaFiles, $testRunner) {
        $totalFiles = count($evaFiles);
        $successCount = 0;
        $totalBlocks = 0;
        
        foreach ($evaFiles as $file) {
            if (file_exists($file)) {
                $parser = new Parser();
                if ($parser->load($file)) {
                    $successCount++;
                    // Count data blocks if possible
                    try {
                        $tables = $parser->getTables();
                        foreach ($tables as $table) {
                            if (is_array($table)) {
                                $totalBlocks += count($table);
                            }
                        }
                    } catch (Exception $e) {
                        // Continue even if counting fails
                    }
                }
            }
        }
        
        $successRate = ($successCount / $totalFiles) * 100;
        
        echo "\n=== VALIDATION SUMMARY ===\n";
        echo "Total files: $totalFiles\n";
        echo "Successfully parsed: $successCount\n";
        echo "Success rate: " . number_format($successRate, 1) . "%\n";
        echo "Total data blocks processed: $totalBlocks\n";
        
        $testRunner->assertTrue($successRate >= 80, 'Success rate should be at least 80%');
        $testRunner->trackCoverage('Summary Statistics');
        
        return true;
    },
    'Generate validation summary statistics'
);

// Run all tests
$testRunner->run();
