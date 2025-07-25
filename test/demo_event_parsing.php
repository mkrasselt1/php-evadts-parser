<?php
/**
 * Demo Event Parsing
 * Demonstrates EVA-DTS event parsing capabilities with detailed output
 */

require_once __DIR__ . '/../vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

echo "======================================================================\n";
echo "EVA-DTS Event Parsing Demo\n";
echo "======================================================================\n\n";

$testFiles = [
    __DIR__ . '/../example/2024-06-05-15-16-Hewa Snack 138.txt',
    __DIR__ . '/../example/2025-01-22-15-27-ACTECH Snack.txt'
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
            
            // Get event data
            $eventData = $parser->getEventData();
            echo "Total events found: " . count($eventData) . "\n";
            
            if (!empty($eventData)) {
                // Show first few events as examples
                echo "\nSample Events:\n";
                $sampleCount = min(5, count($eventData));
                
                for ($i = 0; $i < $sampleCount; $i++) {
                    echo "Event " . ($i + 1) . ":\n";
                    if (is_array($eventData[$i])) {
                        foreach ($eventData[$i] as $key => $value) {
                            echo "  $key: $value\n";
                        }
                    } else {
                        echo "  Data: " . var_export($eventData[$i], true) . "\n";
                    }
                    echo "\n";
                }
                
                // Analyze event patterns
                $eventTypes = [];
                foreach ($eventData as $event) {
                    if (is_array($event)) {
                        $type = $event['type'] ?? $event['event_type'] ?? 'unknown';
                        $eventTypes[$type] = ($eventTypes[$type] ?? 0) + 1;
                    }
                }
                
                if (!empty($eventTypes)) {
                    echo "Event Type Distribution:\n";
                    arsort($eventTypes);
                    foreach ($eventTypes as $type => $count) {
                        echo "  $type: $count occurrences\n";
                    }
                }
            } else {
                echo "No events found in this file.\n";
            }
            
        } else {
            echo "❌ Failed to load file\n";
        }
        
    } catch (Exception $e) {
        echo "❌ ERROR: " . $e->getMessage() . "\n";
    }
    
    echo "\n" . str_repeat("-", 50) . "\n\n";
}

echo "======================================================================\n";
