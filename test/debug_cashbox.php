<?php
/**
 * Debug Cashbox Data Test
 * Analyzes cashbox-related data blocks (coin and bill systems)
 */

require_once __DIR__ . '/../vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

echo "======================================================================\n";
echo "Debug Cashbox Data Test\n";
echo "======================================================================\n\n";

$testFiles = [
    __DIR__ . '/../example/animo.eva_dts',
    __DIR__ . '/../example/sielaff.eva_dts',
    __DIR__ . '/../example/rhevendors.eva_dts'
];

foreach ($testFiles as $file) {
    if (!file_exists($file)) {
        echo "❌ SKIP: File not found - " . basename($file) . "\n";
        continue;
    }
    
    echo "=== " . basename($file) . " ===\n";
    
    try {
        $parser = new Parser();
        if ($parser->load($file)) {
            
            // Get cashbox data
            $cashboxData = $parser->getCashboxData();
            echo "Cashbox Data Entries: " . count($cashboxData) . "\n";
            
            // Get all tables to analyze coin/bill blocks
            $tables = $parser->getTables();
            
            $coinBlocks = 0;
            $billBlocks = 0;
            $cashlessBlocks = 0;
            
            foreach ($tables as $tableName => $rows) {
                foreach ($rows as $row) {
                    if (isset($row['block_type'])) {
                        $blockType = $row['block_type'];
                        
                        if (strpos($blockType, 'CA') === 0) {
                            $coinBlocks++;
                        } elseif (strpos($blockType, 'BA') === 0) {
                            $billBlocks++;
                        } elseif (strpos($blockType, 'DA') === 0) {
                            $cashlessBlocks++;
                        }
                    }
                }
            }
            
            echo "Coin Blocks (CA*): $coinBlocks\n";
            echo "Bill Blocks (BA*): $billBlocks\n";
            echo "Cashless Blocks (DA*): $cashlessBlocks\n";
            
            // Show some sample data if available
            if (!empty($cashboxData)) {
                echo "\nSample Cashbox Data:\n";
                $sample = array_slice($cashboxData, 0, 3);
                foreach ($sample as $entry) {
                    echo "  - " . json_encode($entry) . "\n";
                }
            }
            
        } else {
            echo "❌ Failed to load file\n";
        }
        
    } catch (Exception $e) {
        echo "❌ ERROR: " . $e->getMessage() . "\n";
    }
    
    echo "\n";
}

echo "======================================================================\n";
