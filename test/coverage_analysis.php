<?php
/**
 * EVA-DTS Coverage Analysis
 * Analyzes field coverage and DataBlock implementation
 */

require_once __DIR__ . '/../vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

echo "======================================================================\n";
echo "EVA-DTS Coverage Analysis\n";
echo "======================================================================\n\n";

// All expected DataBlock identifiers
$expectedBlocks = [
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

// Check what DataBlock classes exist
$sourceDir = __DIR__ . '/../src/';
$dataBlockFiles = glob($sourceDir . '*DataBlock.php');

echo "DataBlock Classes Found: " . count($dataBlockFiles) . "\n";
echo "Expected Identifiers: " . count($expectedBlocks) . "\n\n";

$implementedBlocks = [];
foreach ($dataBlockFiles as $file) {
    $className = basename($file, '.php');
    // Extract identifier from class name (e.g., 'CA1DataBlock' -> 'CA1')
    $identifier = str_replace('DataBlock', '', $className);
    $implementedBlocks[] = $identifier;
}

// Analysis
$missing = array_diff($expectedBlocks, $implementedBlocks);
$extra = array_diff($implementedBlocks, $expectedBlocks);
$covered = array_intersect($expectedBlocks, $implementedBlocks);

$coveragePercent = (count($covered) / count($expectedBlocks)) * 100;

echo "======================================================================\n";
echo "IMPLEMENTATION COVERAGE\n";
echo "======================================================================\n";
echo "Implemented: " . count($implementedBlocks) . " classes\n";
echo "Covered: " . count($covered) . "/" . count($expectedBlocks) . " (" . number_format($coveragePercent, 1) . "%)\n";
echo "Missing: " . count($missing) . " identifiers\n";
echo "Extra: " . count($extra) . " implementations\n\n";

if ($coveragePercent >= 95) {
    echo "🎉 EXCELLENT: Nearly complete coverage\n";
} elseif ($coveragePercent >= 85) {
    echo "✅ VERY GOOD: High coverage\n";
} elseif ($coveragePercent >= 75) {
    echo "✅ GOOD: Adequate coverage\n";
} else {
    echo "⚠️  NEEDS IMPROVEMENT: Low coverage\n";
}

if (!empty($missing)) {
    echo "\nMissing DataBlock Implementations:\n";
    foreach ($missing as $block) {
        echo "  - {$block}DataBlock.php\n";
    }
}

if (!empty($extra)) {
    echo "\nExtra DataBlock Implementations:\n";
    foreach ($extra as $block) {
        echo "  + {$block}DataBlock.php\n";
    }
}

// Test file parsing
echo "\n======================================================================\n";
echo "FILE PARSING TEST\n";
echo "======================================================================\n";

$testFiles = glob(__DIR__ . '/../example/*.{eva_dts,txt}', GLOB_BRACE);
$totalFiles = count($testFiles);
$successfulFiles = 0;
$totalBlocks = 0;
$foundTypes = [];

foreach ($testFiles as $file) {
    echo "Testing: " . basename($file) . "... ";
    
    try {
        $parser = new Parser();
        if ($parser->load($file)) {
            $tables = $parser->getTables();
            $fileBlocks = 0;
            
            foreach ($tables as $tableName => $rows) {
                foreach ($rows as $row) {
                    if (isset($row['block_type'])) {
                        $blockType = $row['block_type'];
                        $foundTypes[$blockType] = true;
                        $fileBlocks++;
                        $totalBlocks++;
                    }
                }
            }
            
            echo "✅ OK ($fileBlocks blocks)\n";
            $successfulFiles++;
        } else {
            echo "❌ FAILED\n";
        }
    } catch (Exception $e) {
        echo "❌ ERROR: " . $e->getMessage() . "\n";
    }
}

echo "\nParsing Summary:\n";
echo "Files tested: $totalFiles\n";
echo "Successful: $successfulFiles\n";
echo "Total blocks parsed: $totalBlocks\n";
echo "Unique block types found: " . count($foundTypes) . "\n";

$foundTypesInData = array_keys($foundTypes);
$actualCoverage = count(array_intersect($expectedBlocks, $foundTypesInData));
echo "Actual field coverage in data: " . number_format(($actualCoverage / count($expectedBlocks)) * 100, 1) . "%\n";

echo "\n======================================================================\n";
