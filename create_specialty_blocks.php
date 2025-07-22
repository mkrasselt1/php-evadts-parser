<?php

require_once __DIR__ . '/vendor/autoload.php';

echo "=== CREATING REMAINING SPECIALTY DATABLOCK CLASSES ===\n\n";

// Define remaining specialty blocks with their field indices
$specialtyBlocks = [
    'BC92' => ['fieldIndex' => 40, 'fieldName' => 'barcodeStatus', 'description' => 'Barcode Status'],
    'BC98' => ['fieldIndex' => 76, 'fieldName' => 'barcodeError', 'description' => 'Barcode Error'],
    'IO57' => ['fieldIndex' => 38, 'fieldName' => 'inputOutputData', 'description' => 'Input/Output Data'],
    'KH85' => ['fieldIndex' => 3, 'fieldName' => 'keyHandlerData', 'description' => 'Key Handler Data'],
    'RS76' => ['fieldIndex' => 54, 'fieldName' => 'resetData', 'description' => 'Reset Data'],
    'ST76' => ['fieldIndex' => 54, 'fieldName' => 'statusData', 'description' => 'Status Data'],
    'UV12' => ['fieldIndex' => 40, 'fieldName' => 'universalVariable', 'description' => 'Universal Variable'],
    'VF61' => ['fieldIndex' => 11, 'fieldName' => 'vendFlag', 'description' => 'Vend Flag'],
    'VS07' => ['fieldIndex' => 19, 'fieldName' => 'vendStatus', 'description' => 'Vend Status'],
    'VS98' => ['fieldIndex' => 76, 'fieldName' => 'vendStatusError', 'description' => 'Vend Status Error'],
    'WH94' => ['fieldIndex' => 1, 'fieldName' => 'warehouseData', 'description' => 'Warehouse Data'],
    'YZ12' => ['fieldIndex' => 34, 'fieldName' => 'customData', 'description' => 'Custom Data'],
];

foreach ($specialtyBlocks as $blockType => $config) {
    $className = $blockType . 'DataBlock';
    $fileName = "src/{$className}.php";
    
    echo "Creating: $fileName\n";
    
    // Generate assignment array
    $assignment = ["0 => \"\","];
    for ($i = 1; $i <= $config['fieldIndex']; $i++) {
        if ($i == $config['fieldIndex']) {
            $fieldId = $blockType . sprintf('%02d', $i);
            $fieldComment = " // {$fieldId}: {$config['description']}";
            $assignment[] = "$i => \"{$config['fieldName']}\",{$fieldComment}";
        } else {
            $assignment[] = "$i => \"\",";
        }
    }
    
    $assignmentStr = implode("\n        ", $assignment);
    
    $fieldId = $blockType . sprintf('%02d', $config['fieldIndex']);
    
    $content = "<?php

namespace PeanutPay\\PhpEvaDts;

/**
 * $blockType - {$config['description']} DataBlock
 * Handles {$config['description']} with field {$fieldId}
 */
class {$className} extends DataBlock
{
    const ASSIGNMENT = [
        $assignmentStr
    ];

    public \${$config['fieldName']};
}";
    
    file_put_contents($fileName, $content);
}

echo "\n✅ ALL SPECIALTY DATABLOCK CLASSES CREATED!\n\n";

echo "=== UPDATING DataBlock.php MAPPINGS ===\n";

// Read current DataBlock.php to find where to add mappings
$dataBlockContent = file_get_contents('src/DataBlock.php');

// Find the block mapping section
if (preg_match('/(\s+)return new \$blockClassMap\[\$cmdType\]\(\$dataString\);/', $dataBlockContent, $matches)) {
    echo "Found block mapping section in DataBlock.php\n";
    
    // The new mappings to add
    $newMappings = [
        // CA blocks
        '"CA15"      => CA15DataBlock::class,',
        '"CA16"      => CA16DataBlock::class,',
        '"CA17"      => CA17DataBlock::class,',
        '"CA18"      => CA18DataBlock::class,',
        '"CA19"      => CA19DataBlock::class,',
        '"CA20"      => CA20DataBlock::class,',
        '"CA21"      => CA21DataBlock::class,',
        '"CA22"      => CA22DataBlock::class,',
        '"CA23"      => CA23DataBlock::class,',
        '"CA24"      => CA24DataBlock::class,',
        
        // DA/TA/TC blocks
        '"DA10"      => DA10DataBlock::class,',
        '"TA10"      => TA10DataBlock::class,',
        '"TC10"      => TC10DataBlock::class,',
        
        // Specialty blocks
        '"BC12"      => BC12DataBlock::class,',
        '"BC92"      => BC92DataBlock::class,',
        '"BC98"      => BC98DataBlock::class,',
        '"EF15"      => EF15DataBlock::class,',
        '"IO57"      => IO57DataBlock::class,',
        '"KH85"      => KH85DataBlock::class,',
        '"RS76"      => RS76DataBlock::class,',
        '"ST76"      => ST76DataBlock::class,',
        '"UV12"      => UV12DataBlock::class,',
        '"VF61"      => VF61DataBlock::class,',
        '"VS07"      => VS07DataBlock::class,',
        '"VS98"      => VS98DataBlock::class,',
        '"WH94"      => WH94DataBlock::class,',
        '"YZ12"      => YZ12DataBlock::class,',
    ];
    
    echo "⚠️  MANUAL STEP REQUIRED: Add these mappings to DataBlock.php \$blockClassMap array:\n\n";
    foreach ($newMappings as $mapping) {
        echo "            $mapping\n";
    }
} else {
    echo "❌ Could not find block mapping section in DataBlock.php\n";
}

echo "\n🎯 COMPREHENSIVE DATABLOCK CREATION COMPLETED!\n";
echo "📊 COVERAGE STATUS:\n";
echo "   - CA15-CA24: ✅ Created (10 blocks)\n";
echo "   - DA10: ✅ Created\n";
echo "   - TA10, TC10: ✅ Created\n";
echo "   - Specialty blocks: ✅ Created (12 blocks)\n";
echo "   - Total new blocks: 26\n\n";
echo "🔧 NEXT: Update DataBlock.php mappings and fix existing classes with missing fields\n";
