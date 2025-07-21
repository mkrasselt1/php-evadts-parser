<?php

require_once __DIR__ . '/vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

// Test file
$testFile = __DIR__ . '/example/2025-06-20-13-46-Hewa Luce 1 #39 Links.txt';

echo "=== DETAILED PRODUCT 5 ANALYSIS ===\n";

// Create parser and load file
$parser = new Parser();
$parser->load($testFile);

echo "=== getSalesData() for Product 5 ===\n";
$salesData = $parser->getSalesData();
foreach ($salesData as $sale) {
    if ($sale['product_id'] == '5') {
        print_r($sale);
    }
}

echo "\n=== getProductData() for Product 5 ===\n";
$productData = $parser->getProductData();
foreach ($productData as $product) {
    if ($product['product_id'] == '5') {
        print_r($product);
    }
}

echo "\n=== generateSalesReport() revenue_by_product for Product 5 ===\n";
$salesReport = $parser->generateSalesReport();
foreach ($salesReport['revenue_by_product'] as $product) {
    if ($product['product_id'] == '5') {
        print_r($product);
    }
}

echo "\n=== generateProductReport() for Product 5 ===\n";
$productReport = $parser->generateProductReport();
foreach ($productReport['product_performance'] as $product) {
    if ($product['product_id'] == '5') {
        print_r($product);
    }
}
