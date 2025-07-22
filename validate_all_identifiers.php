<?php

require_once __DIR__ . '/vendor/autoload.php';

echo "=== EXTRACTING ALL EVA-DTS FIELD IDENTIFIERS FROM OFFICIAL DOCUMENTATION ===\n\n";

// Read the HTML documentation
$htmlFile = __DIR__ . '/EVA-DTS-6.1.2-converted.html';
$htmlContent = file_get_contents($htmlFile);

// Extract all field identifiers using regex pattern
preg_match_all('/([A-Z]{2}\d{4})/', $htmlContent, $matches);
$allIdentifiers = array_unique($matches[1]);
sort($allIdentifiers);

echo "Found " . count($allIdentifiers) . " unique field identifiers in documentation:\n";

// Group by block type
$groupedIdentifiers = [];
foreach ($allIdentifiers as $identifier) {
    if (preg_match('/^([A-Z]{2})(\d{2})(\d{2})$/', $identifier, $matches)) {
        $blockType = $matches[1] . $matches[2]; // e.g., "CA14"
        $fieldIndex = (int)$matches[3]; // e.g., 01 = 1
        
        if (!isset($groupedIdentifiers[$blockType])) {
            $groupedIdentifiers[$blockType] = [];
        }
        $groupedIdentifiers[$blockType][$fieldIndex] = $identifier;
    }
}

// Display grouped identifiers
foreach ($groupedIdentifiers as $blockType => $fields) {
    echo "\n$blockType Block:\n";
    ksort($fields);
    foreach ($fields as $index => $identifier) {
        echo "  $identifier (field index $index)\n";
    }
}

echo "\n=== CHECKING AGAINST OUR DATABLOCK IMPLEMENTATIONS ===\n\n";

// Get all DataBlock classes
$dataBlockFiles = glob(__DIR__ . '/src/*DataBlock.php');

$blockClassMapping = [
    'CA11' => 'CoinAcceptedDataBlock', // Actually should be for coins
    'CA14' => 'CoinAcceptedDataBlock', // Currently used for bills (needs rename)
    'CA12' => 'CoinDispensedDataBlock',
    'CA13' => 'CoinFilledDataBlock',
    'CA01' => 'CashReportDataBlock',
    'CA02' => 'CoinVendsDataBlock', 
    'CA03' => 'CashReportDataBlock',
    'CA04' => 'CashDiscountsDataBlock',
    'CA07' => 'CoinChangeDataBlock',
    'CA10' => 'CashlessIDDataBlock',
    'CB01' => 'ControlBoardDataBlock',
    'DB01' => 'DataBlock', // Generic
    'DB02' => 'DataBlock',
    'DB04' => 'DataBlock',
    'DB05' => 'DataBlock',
    'DB10' => 'DataBlock',
    'DX01' => 'DXSDataBlock',
    'DX02' => 'DXSDataBlock',
    'EA01' => 'EventDataBlock',
    'EA02' => 'EventDataBlock',
    'EA03' => 'EventDataBlock',
    'EA04' => 'EventDataBlock',
    'EA07' => 'EventDataBlock',
    'ED01' => 'EventDetailsDataBlock',
    'G885' => 'GatewayIDDataBlock',
    'ID01' => 'VMCIDDataBlock',
    'ID02' => 'BillIDDataBlock',
    'ID03' => 'CoinIDDataBlock',
    'ID04' => 'CashlessIDDataBlock',
    'LA01' => 'PriceListVendsDataBlock',
    'PA01' => 'ProductDataBlock',
    'PA02' => 'ProductVendsDataBlock',
    'PA03' => 'ProductTestVendsDataBlock',
    'PA04' => 'ProductFreeVendsDataBlock',
    'PA05' => 'ProductVendsNewDataBlock',
    'PA08' => 'ProductDataBlock',
    'PC01' => 'PowerOutDataBlock',
    'PP01' => 'ProductDataBlock',
    'SE01' => 'STDataBlock',
    'TA01' => 'TimeDataBlock',
    'TA02' => 'DataBlock',
    'TA03' => 'DataBlock',
    'TA05' => 'DataBlock',
    'VA01' => 'CurrencyDataBlock',
    'VA02' => 'DataBlock',
    'VA03' => 'DataBlock',
    'VD01' => 'VendsPaidDataBlock',
    'VD02' => 'VendsTestDataBlock', 
    'VD03' => 'VendsFreeDataBlock',
];

echo "=== CHECKING EACH DATABLOCK CLASS ===\n\n";

foreach ($dataBlockFiles as $file) {
    $fileName = basename($file);
    $className = str_replace('.php', '', $fileName);
    
    echo "Checking: $className\n";
    
    // Read the file content
    $content = file_get_contents($file);
    
    // Extract ASSIGNMENT array
    if (preg_match('/const\s+ASSIGNMENT\s*=\s*\[(.*?)\];/s', $content, $matches)) {
        $assignmentContent = $matches[1];
        echo "  ✅ Has ASSIGNMENT array\n";
        
        // Parse assignment array
        preg_match_all('/(\d+)\s*=>\s*["\']([^"\']*)["\']/', $assignmentContent, $assignmentMatches);
        
        $assignments = [];
        for ($i = 0; $i < count($assignmentMatches[1]); $i++) {
            $index = (int)$assignmentMatches[1][$i];
            $fieldName = $assignmentMatches[2][$i];
            if (!empty($fieldName)) {
                $assignments[$index] = $fieldName;
            }
        }
        
        if (count($assignments) > 0) {
            echo "  Field mappings:\n";
            foreach ($assignments as $index => $fieldName) {
                echo "    [$index] => '$fieldName'\n";
            }
        } else {
            echo "  ⚠️  No field mappings found in ASSIGNMENT\n";
        }
        
        // Try to find which block types this class should handle
        $possibleBlocks = [];
        foreach ($blockClassMapping as $blockType => $mappedClass) {
            if ($mappedClass === $className) {
                $possibleBlocks[] = $blockType;
            }
        }
        
        if (count($possibleBlocks) > 0) {
            echo "  Should handle blocks: " . implode(', ', $possibleBlocks) . "\n";
            
            // Check if we have documentation for these blocks
            foreach ($possibleBlocks as $blockType) {
                if (isset($groupedIdentifiers[$blockType])) {
                    echo "  📋 $blockType documentation fields: " . implode(', ', array_values($groupedIdentifiers[$blockType])) . "\n";
                    
                    // Compare with our implementation
                    $docFields = $groupedIdentifiers[$blockType];
                    $maxIndex = max(array_keys($docFields));
                    
                    echo "  Validation:\n";
                    for ($i = 0; $i <= $maxIndex; $i++) {
                        $hasDoc = isset($docFields[$i]);
                        $hasImpl = isset($assignments[$i]);
                        
                        if ($hasDoc && $hasImpl) {
                            echo "    ✅ Index $i: {$docFields[$i]} → '{$assignments[$i]}'\n";
                        } elseif ($hasDoc && !$hasImpl) {
                            echo "    ❌ Index $i: {$docFields[$i]} → MISSING in implementation\n";
                        } elseif (!$hasDoc && $hasImpl) {
                            echo "    ⚠️  Index $i: NOT in docs → '{$assignments[$i]}' (extra field)\n";
                        }
                    }
                } else {
                    echo "  ❓ No documentation found for $blockType\n";
                }
            }
        } else {
            echo "  ❓ No known block type mapping for this class\n";
        }
        
    } else {
        echo "  ❌ No ASSIGNMENT array found\n";
    }
    
    echo "\n";
}

echo "=== SUMMARY ===\n";
echo "Total identifiers in documentation: " . count($allIdentifiers) . "\n";
echo "Block types found: " . count($groupedIdentifiers) . "\n";
echo "DataBlock classes analyzed: " . count($dataBlockFiles) . "\n";
echo "\nNext steps:\n";
echo "1. Update ASSIGNMENT arrays based on documentation\n";
echo "2. Rename CoinAcceptedDataBlock to BillAcceptedDataBlock for CA14\n";
echo "3. Create separate CoinAcceptedDataBlock for CA11\n";
echo "4. Ensure all documented fields are implemented\n";
