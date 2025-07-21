<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

// Example usage of the new generateSalesTable() function
$filename = __DIR__ . '/animo.eva_dts';

if (file_exists($filename)) {
    $parser = new Parser();
    
    // Load and parse the EVA DTS file
    if ($parser->load($filename)) {
        $report = $parser->getReport();
        
        // Generate the sales table
        $salesTable = $report->generateSalesTable();
        
        // Display the results
        echo "=== SALES REPORT ===\n\n";
        
        // Summary
        echo "SUMMARY:\n";
        echo "Total Pricelists: " . $salesTable['summary']['total_pricelists'] . "\n";
        echo "Total Products: " . $salesTable['summary']['total_products'] . "\n";
        echo "Total Sales Amount: " . $salesTable['summary']['total_sales_amount'] . "\n";
        echo "Total Sales Value: " . number_format($salesTable['summary']['total_sales_value'], 2) . "\n\n";
        
        // Pricelists
        echo "PRICELISTS:\n";
        foreach ($salesTable['pricelists'] as $pricelist) {
            echo "Pricelist ID: " . $pricelist['pricelist_id'] . " (" . $pricelist['total_products'] . " products)\n";
            
            foreach ($pricelist['products'] as $product) {
                echo "  Product " . $product['product_number'] . 
                     " (" . $product['name'] . "): " . 
                     number_format($product['price'], 2) . 
                     " - Sales: " . $product['total_sales_amount'] . 
                     " units = " . number_format($product['total_sales_value'], 2) . 
                     " (" . ($product['active'] ? 'Active' : 'Inactive') . ")\n";
            }
            echo "\n";
        }
        
        // All Products
        echo "ALL PRODUCTS:\n";
        foreach ($salesTable['products'] as $product) {
            echo "Product " . $product['product_number'] . 
                 " (" . $product['name'] . "): " . 
                 number_format($product['price'], 2) . 
                 " - Total Sales: " . $product['sales_amount'] . 
                 " units = " . number_format($product['sales_value'], 2) . 
                 " (" . ($product['active'] ? 'Active' : 'Inactive') . ")\n";
        }
        
        // Output as JSON for easier processing
        echo "\n\n=== JSON OUTPUT ===\n";
        echo json_encode($salesTable, JSON_PRETTY_PRINT);
    } else {
        echo "Failed to parse the EVA DTS file: $filename\n";
    }
    
} else {
    echo "Example file not found: $filename\n";
    echo "Please make sure the animo.eva_dts file exists in the example directory.\n";
}
