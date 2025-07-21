<?php

require_once __DIR__ . '/vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

// Test file
$testFile = __DIR__ . '/example/2025-06-20-13-46-Hewa Luce 1 #39 Links.txt';

echo "=== TESTING IMPROVED PRODUCT CATEGORIES ===\n";

// Create parser and load file
$parser = new Parser();
$parser->load($testFile);

$productData = $parser->getProductData();

echo "=== ALLE PRODUKTE MIT KATEGORIEN ===\n";
$categoryCount = [];

foreach ($productData as $product) {
    $category = $product['category'];
    $categoryCount[$category] = ($categoryCount[$category] ?? 0) + 1;
    
    echo "ID: {$product['product_id']} | Name: {$product['name']} | Kategorie: {$category}\n";
}

echo "\n=== KATEGORIE ZUSAMMENFASSUNG ===\n";
foreach ($categoryCount as $category => $count) {
    echo "{$category}: {$count} Produkte\n";
}

echo "\n=== SPEZIELLE TESTS ===\n";

// Test specific product names
$testNames = [
    'CHOCO BOHNE',
    'HOT CHOCOLATE', 
    'LATTE MACCHIATO BOHNE',
    'KAFFEE SCHWARZ',
    'SCHOKOLADE HEISS',
    'COLA ZERO',
    'CHIPS PAPRIKA',
    'SANDWICH SCHINKEN'
];

foreach ($testNames as $testName) {
    $reflection = new ReflectionClass($parser);
    $method = $reflection->getMethod('determineProductCategory');
    $method->setAccessible(true);
    $category = $method->invoke($parser, $testName);
    echo "'{$testName}' -> {$category}\n";
}
