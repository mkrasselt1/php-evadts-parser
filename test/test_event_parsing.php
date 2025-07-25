<?php
/**
 * Event Parsing Test
 * Tests EVA-DTS event data parsing and analysis
 */

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/TestRunner.php';

use PeanutPay\PhpEvaDts\Parser;

$testRunner = new TestRunner();

// Test event data extraction
$testRunner->addTest(
    'event_data_extraction',
    function() use ($testRunner) {
        $parser = new Parser();
        $testFile = __DIR__ . '/../example/2024-06-05-15-16-Hewa Snack 138.txt';
        
        if ($parser->load($testFile)) {
            $eventData = $parser->getEventData();
            $testRunner->assertTrue(is_array($eventData), 'getEventData should return array');
            
            if (!empty($eventData)) {
                echo "Event Data Analysis:\n";
                echo "Total events: " . count($eventData) . "\n";
                
                // Analyze event types
                $eventTypes = [];
                foreach ($eventData as $event) {
                    if (isset($event['event_type'])) {
                        $type = $event['event_type'];
                        $eventTypes[$type] = ($eventTypes[$type] ?? 0) + 1;
                    }
                }
                
                if (!empty($eventTypes)) {
                    echo "Event types found:\n";
                    foreach ($eventTypes as $type => $count) {
                        echo "  $type: $count events\n";
                    }
                }
                echo "\n";
            }
            
            $testRunner->trackCoverage('Event Parsing');
            return true;
        }
        return 'Failed to load test file';
    },
    'Test event data extraction and analysis'
);

// Test event validation
$testRunner->addTest(
    'event_validation',
    function() use ($testRunner) {
        $parser = new Parser();
        $testFile = __DIR__ . '/../example/2024-06-05-15-16-Hewa Snack 138.txt';
        
        if ($parser->load($testFile)) {
            $eventData = $parser->getEventData();
            
            if (!empty($eventData)) {
                $validEvents = 0;
                $totalEvents = count($eventData);
                
                foreach ($eventData as $event) {
                    // Basic validation - event should have some recognizable structure
                    if (is_array($event) && !empty($event)) {
                        $validEvents++;
                    }
                }
                
                $validationRate = ($validEvents / $totalEvents) * 100;
                echo "Event Validation Results:\n";
                echo "Total events: $totalEvents\n";
                echo "Valid events: $validEvents\n";
                echo "Validation rate: " . number_format($validationRate, 1) . "%\n\n";
                
                $testRunner->assertTrue($validationRate >= 80, 'At least 80% of events should be valid');
            }
            
            $testRunner->trackCoverage('Event Validation');
            return true;
        }
        return 'Failed to load test file';
    },
    'Test event data validation and integrity'
);

// Test multiple file event parsing
$testRunner->addTest(
    'multi_file_event_parsing',
    function() use ($testRunner) {
        $testFiles = [
            __DIR__ . '/../example/2024-06-05-15-16-Hewa Snack 138.txt',
            __DIR__ . '/../example/2025-01-22-15-27-ACTECH Snack.txt'
        ];
        
        $totalEvents = 0;
        $filesWithEvents = 0;
        
        foreach ($testFiles as $file) {
            if (file_exists($file)) {
                $parser = new Parser();
                if ($parser->load($file)) {
                    $eventData = $parser->getEventData();
                    if (!empty($eventData)) {
                        $totalEvents += count($eventData);
                        $filesWithEvents++;
                    }
                }
            }
        }
        
        echo "Multi-file Event Analysis:\n";
        echo "Files tested: " . count($testFiles) . "\n";
        echo "Files with events: $filesWithEvents\n";
        echo "Total events found: $totalEvents\n\n";
        
        $testRunner->trackCoverage('Multi-file Processing');
        return true;
    },
    'Test event parsing across multiple files'
);

// Run all tests
$testRunner->run();
