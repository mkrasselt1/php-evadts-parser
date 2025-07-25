<?php
/**
 * Validate All Identifiers Test
 * Tests coverage of all EVA-DTS field identifiers
 */

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/TestRunner.php';

use PeanutPay\PhpEvaDts\Parser;

$testRunner = new TestRunner();

// Complete list of EVA-DTS 6.1.2 field identifiers
$allIdentifiers = [
    // Audit Module
    'AM1',
    
    // Bill Acceptor
    'BA1', 'BA2', 'BA3', 'BA4',
    
    // Coin Acceptor/Changer
    'CA1', 'CA2', 'CA3', 'CA4', 'CA5', 'CA6', 'CA7', 'CA8', 'CA9', 'CA10',
    'CA11', 'CA12', 'CA13', 'CA14', 'CA15', 'CA16', 'CA17', 'CA18', 'CA19', 'CA20',
    'CA21', 'CA22', 'CA23', 'CA24',
    
    // Control Board
    'CB1',
    
    // Cashless Device
    'DA1', 'DA2', 'DA3', 'DA4', 'DA5', 'DA6', 'DA7',
    
    // Database/Device-specific
    'DB1', 'DB2', 'DB3', 'DB4', 'DB5', 'DB6', 'DB7', 'DB8', 'DB9', 'DB10',
    
    // Data Exchange
    'DXS', 'DXE',
    
    // Events/Alarms
    'EA1', 'EA2', 'EA3', 'EA4', 'EA5', 'EA6', 'EA7', 'EA250705',
    'EADXS',
    
    // Generic
    'G85',
    
    // Identification
    'ID1', 'ID4', 'ID5', 'ID6',
    
    // List/Price
    'LA1',
    
    // Machine
    'MA5',
    
    // Product
    'PA1', 'PA2', 'PA3', 'PA4', 'PA5', 'PA6', 'PA7', 'PA8',
    
    // Position
    'PP1',
    
    // Sales Audit
    'SA1', 'SA2',
    
    // System Data
    'SD1',
    
    // Segment/Session
    'SE', 'ST',
    
    // Time/Date
    'TA1', 'TA2', 'TA3', 'TA4', 'TA5',
    
    // Vend Audit
    'VA1', 'VA2', 'VA3',
    
    // VMC
    'VM1'
];

echo "Testing coverage of " . count($allIdentifiers) . " EVA-DTS field identifiers\n\n";

// Test identifier recognition
$testRunner->addTest(
    'identifier_recognition',
    function() use ($allIdentifiers, $testRunner) {
        $recognizedCount = 0;
        $sourceDir = __DIR__ . '/../src/';
        
        foreach ($allIdentifiers as $identifier) {
            $classFile = $sourceDir . $identifier . 'DataBlock.php';
            if (file_exists($classFile)) {
                $recognizedCount++;
            }
        }
        
        $coverage = ($recognizedCount / count($allIdentifiers)) * 100;
        
        echo "Identifier Recognition Results:\n";
        echo "Total identifiers: " . count($allIdentifiers) . "\n";
        echo "Recognized (have DataBlock classes): $recognizedCount\n";
        echo "Coverage: " . number_format($coverage, 1) . "%\n\n";
        
        $testRunner->assertTrue($coverage >= 30, 'Should recognize at least 30% of identifiers');
        $testRunner->trackCoverage('Identifier Recognition');
        
        return true;
    },
    'Test recognition of standard EVA-DTS identifiers'
);

// Test identifier parsing in real files
$testRunner->addTest(
    'identifier_parsing_in_files',
    function() use ($allIdentifiers, $testRunner) {
        $foundIdentifiers = [];
        $testFiles = glob(__DIR__ . '/../example/*.{eva_dts,txt}', GLOB_BRACE);
        
        foreach ($testFiles as $file) {
            if (file_exists($file)) {
                $content = file_get_contents($file);
                $lines = explode("\n", $content);
                
                foreach ($lines as $line) {
                    $line = trim($line);
                    if (!empty($line)) {
                        $parts = explode('*', $line);
                        if (!empty($parts[0])) {
                            $identifier = $parts[0];
                            if (in_array($identifier, $allIdentifiers)) {
                                $foundIdentifiers[$identifier] = true;
                            }
                        }
                    }
                }
            }
        }
        
        $foundCount = count($foundIdentifiers);
        $dataRate = ($foundCount / count($allIdentifiers)) * 100;
        
        echo "Identifier Usage in Data Files:\n";
        echo "Identifiers found in data: $foundCount\n";
        echo "Data coverage: " . number_format($dataRate, 1) . "%\n";
        echo "Files analyzed: " . count($testFiles) . "\n\n";
        
        if ($foundCount > 0) {
            echo "Found identifiers: " . implode(', ', array_keys($foundIdentifiers)) . "\n\n";
        }
        
        $testRunner->trackCoverage('Data File Analysis');
        return true;
    },
    'Test identifier usage in real data files'
);

// Test identifier categories
$testRunner->addTest(
    'identifier_categories',
    function() use ($allIdentifiers, $testRunner) {
        $categories = [
            'AM' => 'Audit Module',
            'BA' => 'Bill Acceptor', 
            'CA' => 'Coin Acceptor/Changer',
            'CB' => 'Control Board',
            'DA' => 'Cashless Device',
            'DB' => 'Database/Device-specific',
            'DX' => 'Data Exchange',
            'EA' => 'Events/Alarms',
            'G8' => 'Generic',
            'ID' => 'Identification',
            'LA' => 'List/Price',
            'MA' => 'Machine',
            'PA' => 'Product',
            'PP' => 'Position',
            'SA' => 'Sales Audit',
            'SD' => 'System Data',
            'SE' => 'Segment',
            'ST' => 'Session',
            'TA' => 'Time/Date',
            'VA' => 'Vend Audit',
            'VM' => 'VMC'
        ];
        
        echo "Identifier Categories Analysis:\n";
        
        foreach ($categories as $prefix => $description) {
            $count = 0;
            foreach ($allIdentifiers as $identifier) {
                if (strpos($identifier, $prefix) === 0) {
                    $count++;
                }
            }
            if ($count > 0) {
                echo sprintf("%-30s: %2d identifiers\n", $description, $count);
            }
        }
        
        $testRunner->trackCoverage('Category Analysis');
        return true;
    },
    'Analyze identifier categories and distribution'
);

// Run all tests
$testRunner->run();
