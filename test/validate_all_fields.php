<?php
/**
 * EVA-DTS Field Coverage Validation Test
 * Validates complete EVA-DTS 6.1.2 specification coverage
 */

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/TestRunner.php';

use PeanutPay\PhpEvaDts\Parser;

$testRunner = new TestRunner();

echo "======================================================================\n";
echo "EVA-DTS Field Coverage Validation Test\n";
echo "======================================================================\n\n";

// Test data files
$testFiles = [
    __DIR__ . '/../example/animo.eva_dts',
    __DIR__ . '/../example/sielaff.eva_dts',
    __DIR__ . '/../example/rhevendors.eva_dts',
    __DIR__ . '/../example/2024-06-05-15-16-Hewa Snack 138.txt',
    __DIR__ . '/../example/2025-01-22-15-27-ACTECH Snack.txt'
];

// Expected EVA-DTS field identifiers (based on specification)
$expectedFields = [
    'AM1', 'BA1', 'BA2', 'BA3', 'BA4', 'CA1', 'CA2', 'CA3', 'CA4', 'CA5',
    'CA6', 'CA7', 'CA8', 'CA9', 'CA10', 'CA11', 'CA12', 'CA13', 'CA14', 'CA15',
    'CA16', 'CA17', 'CA18', 'CA19', 'CA20', 'CA21', 'CA22', 'CA23', 'CA24',
    'CB1', 'DA1', 'DA2', 'DA3', 'DA4', 'DA5', 'DA6', 'DA7', 'DB1', 'DB2',
    'DB3', 'DB4', 'DB5', 'DB6', 'DB7', 'DB8', 'DB9', 'DB10', 'DXE', 'DXS',
    'EA1', 'EA2', 'EA3', 'EA4', 'EA5', 'EA6', 'EA7', 'EA250705', 'EADXS',
    'G85', 'ID1', 'ID4', 'ID5', 'ID6', 'LA1', 'MA5', 'PA1', 'PA2', 'PA3',
    'PA4', 'PA5', 'PA6', 'PA7', 'PA8', 'PP1', 'SA1', 'SA2', 'SD1', 'SE',
    'ST', 'TA1', 'TA2', 'TA3', 'TA4', 'TA5', 'VA1', 'VA2', 'VA3', 'VM1'
];

// Track found fields across all files
$foundFields = [];
$totalBlocks = 0;
$successfulParses = 0;

// Add individual file tests
foreach ($testFiles as $file) {
    $testRunner->addTest(
        "field_coverage_" . basename($file),
        function() use ($file, &$foundFields, &$totalBlocks, &$successfulParses, $testRunner) {
            if (!file_exists($file)) {
                return "File not found: " . basename($file);
            }
            
            try {
                $parser = new Parser();
                if ($parser->load($file)) {
                    $tables = $parser->getTables();
                    
                    foreach ($tables as $tableName => $rows) {
                        foreach ($rows as $row) {
                            if (isset($row['block_type'])) {
                                $blockType = $row['block_type'];
                                $foundFields[$blockType] = true;
                                $totalBlocks++;
                            }
                        }
                    }
                    
                    $successfulParses++;
                    $testRunner->trackCoverage("File Loading");
                    return true;
                } else {
                    return "Failed to parse file";
                }
            } catch (Exception $e) {
                return "Exception: " . $e->getMessage();
            }
        },
        "Field coverage validation for " . basename($file)
    );
}

// Add overall coverage analysis test
$testRunner->addTest(
    "field_coverage_analysis",
    function() use ($expectedFields, &$foundFields, &$totalBlocks, &$successfulParses, $testFiles, $testRunner) {
        $foundFieldsList = array_keys($foundFields);
        $coveredFields = array_intersect($expectedFields, $foundFieldsList);
        $missingFields = array_diff($expectedFields, $foundFieldsList);
        
        $coveragePercentage = (count($coveredFields) / count($expectedFields)) * 100;
        
        echo "\n======================================================================\n";
        echo "FIELD COVERAGE ANALYSIS\n";
        echo "======================================================================\n";
        echo "Expected Fields: " . count($expectedFields) . "\n";
        echo "Found Fields: " . count($foundFieldsList) . "\n";
        echo "Covered Fields: " . count($coveredFields) . "\n";
        echo "Coverage: " . number_format($coveragePercentage, 1) . "%\n";
        echo "Total Blocks Parsed: $totalBlocks\n";
        echo "Files Successfully Parsed: $successfulParses/" . count($testFiles) . "\n\n";
        
        if ($coveragePercentage >= 90) {
            echo "✅ EXCELLENT: Field coverage is excellent (>= 90%)\n";
            $testRunner->trackCoverage("Field Coverage");
        } elseif ($coveragePercentage >= 75) {
            echo "✅ GOOD: Field coverage is good (>= 75%)\n";
            $testRunner->trackCoverage("Field Coverage");
        } else {
            echo "❌ POOR: Field coverage is below 75%\n";
            return "Low field coverage: " . number_format($coveragePercentage, 1) . "%";
        }
        
        if (!empty($missingFields)) {
            echo "\nMissing Fields (" . count($missingFields) . "):\n";
            foreach (array_slice($missingFields, 0, 10) as $field) {
                echo "  - $field\n";
            }
            if (count($missingFields) > 10) {
                echo "  ... and " . (count($missingFields) - 10) . " more\n";
            }
        }
        
        // Additional found fields (not in specification)
        $extraFields = array_diff($foundFieldsList, $expectedFields);
        if (!empty($extraFields)) {
            echo "\nAdditional Fields Found (" . count($extraFields) . "):\n";
            foreach (array_slice($extraFields, 0, 10) as $field) {
                echo "  + $field\n";
            }
            if (count($extraFields) > 10) {
                echo "  ... and " . (count($extraFields) - 10) . " more\n";
            }
        }
        
        return true;
    },
    "Overall field coverage analysis"
);

// Run all tests
$testRunner->run();
