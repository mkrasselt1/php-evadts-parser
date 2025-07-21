#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

/**
 * EVA DTS Sales Report CLI Tool
 */

function showUsage() {
    echo "EVA DTS Sales Report Tool\n";
    echo "========================\n\n";
    echo "Usage: php sales_report.php [options] <eva_dts_file>\n\n";
    echo "Options:\n";
    echo "  --format=table    Show formatted table output (default)\n";
    echo "  --format=json     Show JSON output\n";
    echo "  --format=both     Show both table and JSON output\n";
    echo "  --help, -h        Show this help message\n\n";
    echo "Examples:\n";
    echo "  php sales_report.php animo.eva_dts\n";
    echo "  php sales_report.php --format=json sielaff.eva_dts\n";
    echo "  php sales_report.php --format=both rhevendors.eva_dts\n\n";
}

function parseArguments($argv) {
    $options = [
        'format' => 'table',
        'file' => null,
        'help' => false
    ];
    
    for ($i = 1; $i < count($argv); $i++) {
        $arg = $argv[$i];
        
        if ($arg === '--help' || $arg === '-h') {
            $options['help'] = true;
        } elseif (strpos($arg, '--format=') === 0) {
            $format = substr($arg, 9);
            if (in_array($format, ['table', 'json', 'both'])) {
                $options['format'] = $format;
            } else {
                echo "Error: Invalid format '$format'. Use 'table', 'json', or 'both'.\n";
                exit(1);
            }
        } elseif (substr($arg, 0, 2) !== '--') {
            if ($options['file'] === null) {
                $options['file'] = $arg;
            } else {
                echo "Error: Multiple files specified. Only one file is allowed.\n";
                exit(1);
            }
        } else {
            echo "Error: Unknown option '$arg'\n";
            exit(1);
        }
    }
    
    return $options;
}

// Parse command line arguments
$options = parseArguments($argv);

// Show help if requested or no file specified
if ($options['help'] || $options['file'] === null) {
    showUsage();
    exit($options['help'] ? 0 : 1);
}

// Check if file exists
$filename = $options['file'];
if (!file_exists($filename)) {
    echo "Error: File '$filename' not found.\n";
    exit(1);
}

// Parse the EVA DTS file
$parser = new Parser();
if (!$parser->load($filename)) {
    echo "Error: Failed to parse EVA DTS file '$filename'.\n";
    exit(1);
}

$report = $parser->getReport();

// Generate output based on format option
switch ($options['format']) {
    case 'table':
        echo $report->generateSalesTableString();
        break;
        
    case 'json':
        $salesTable = $report->generateSalesTable();
        echo json_encode($salesTable, JSON_PRETTY_PRINT) . "\n";
        break;
        
    case 'both':
        echo $report->generateSalesTableString();
        echo "\n" . str_repeat("=", 50) . "\n";
        echo "JSON DATA:\n";
        echo str_repeat("=", 50) . "\n";
        $salesTable = $report->generateSalesTable();
        echo json_encode($salesTable, JSON_PRETTY_PRINT) . "\n";
        break;
}

exit(0);
