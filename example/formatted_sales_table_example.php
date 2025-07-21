<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

// Example usage of the new generateSalesTableString() function
$filename = __DIR__ . '/animo.eva_dts';

if (file_exists($filename)) {
    $parser = new Parser();
    
    // Load and parse the EVA DTS file
    if ($parser->load($filename)) {
        $report = $parser->getReport();
        
        // Generate the formatted sales table string
        echo $report->generateSalesTableString();
        
        // Optionally also show the JSON data
        echo "\n\n" . str_repeat("=", 50) . "\n";
        echo "JSON DATA (for further processing):\n";
        echo str_repeat("=", 50) . "\n";
        $salesTable = $report->generateSalesTable();
        echo json_encode($salesTable, JSON_PRETTY_PRINT);
        
    } else {
        echo "Failed to parse the EVA DTS file: $filename\n";
    }
} else {
    echo "Example file not found: $filename\n";
    echo "Please make sure the animo.eva_dts file exists in the example directory.\n";
}
