<?php

require_once __DIR__ . '/vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

// Test file
$testFile = __DIR__ . '/example/2025-06-20-13-46-Hewa Luce 1 #39 Links.txt';

echo "=== TESTING PRICE COMPARISON LOGIC ===\n";

// Create parser and load file
$parser = new Parser();
$parser->load($testFile);

$productData = $parser->getProductData();

echo "=== PRODUCTS WITH MULTIPLE PRICELISTS ===\n";
foreach ($productData as $product) {
    if (isset($product['sales_data']['all_pricelists']) && count($product['sales_data']['all_pricelists']) > 1) {
        echo "Product " . $product['product_id'] . " (" . $product['name'] . "):\n";
        echo "  Selected Price: " . $product['price'] . " EUR (Pricelist " . $product['sales_data']['pricelist_id'] . ")\n";
        echo "  All Pricelists:\n";
        foreach ($product['sales_data']['all_pricelists'] as $pricelistId => $data) {
            echo "    Pricelist $pricelistId: " . $data['price'] . " EUR\n";
        }
        echo "\n";
    }
}

echo "=== RAW PRICE COMPARISON TEST ===\n";
// Simulate the comparison logic
$testData = [
    ['product' => 7, 'pricelist' => 0, 'price' => 100], // 1.00 EUR
    ['product' => 7, 'pricelist' => 1, 'price' => 20],  // 0.20 EUR
];

$priceData = [];
foreach ($testData as $data) {
    $productNumber = $data['product'];
    $priceList = $data['pricelist'];
    $price = $data['price'];
    
    echo "Processing Product $productNumber, Pricelist $priceList, Price $price cent:\n";
    
    $existingPriceInCent = isset($priceData[$productNumber]) ? ($priceData[$productNumber]['price'] * 100) : 0;
    echo "  Existing price in cent: $existingPriceInCent\n";
    echo "  New price in cent: $price\n";
    echo "  Should update? ";
    
    if (!isset($priceData[$productNumber]) || 
        $priceList == 0 || 
        $price > $existingPriceInCent) {
        echo "YES\n";
        $priceData[$productNumber] = [
            'pricelist_id' => $priceList,
            'price' => $price / 100,
        ];
    } else {
        echo "NO\n";
    }
    echo "  Result: " . ($priceData[$productNumber]['price'] ?? 0) . " EUR (Pricelist " . ($priceData[$productNumber]['pricelist_id'] ?? 'none') . ")\n\n";
}
