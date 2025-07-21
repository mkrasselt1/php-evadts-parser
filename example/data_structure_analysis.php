<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

$testFile = __DIR__ . '/2025-06-20-13-46-Hewa Luce 1 #39 Links.txt';

echo "=== STRUKTUR ANALYSE FÜR PRODUCT REPORT ===\n\n";

$parser = new Parser();
$parser->load($testFile);

// 1. Check generateProductReport structure
echo "1. generateProductReport() Struktur:\n";
$productReport = $parser->generateProductReport();
echo "Keys: " . implode(', ', array_keys($productReport)) . "\n\n";

if (isset($productReport['product_performance'])) {
    echo "product_performance Struktur (erste 2 Einträge):\n";
    for ($i = 0; $i < min(2, count($productReport['product_performance'])); $i++) {
        $product = $productReport['product_performance'][$i];
        echo "Eintrag $i:\n";
        foreach ($product as $key => $value) {
            echo "  $key: " . var_export($value, true) . "\n";
        }
        echo "\n";
    }
}

// 2. Check getProductData structure
echo "2. getProductData() Struktur:\n";
$productData = $parser->getProductData();
if (!empty($productData)) {
    echo "Erste Produkt-Struktur:\n";
    $firstProduct = $productData[0];
    foreach ($firstProduct as $key => $value) {
        echo "  $key: " . var_export($value, true) . "\n";
    }
}

// 3. Check getSalesData structure
echo "\n3. getSalesData() Struktur:\n";
$salesData = $parser->getSalesData();
if (!empty($salesData)) {
    echo "Erste Verkaufs-Struktur:\n";
    $firstSale = $salesData[0];
    foreach ($firstSale as $key => $value) {
        echo "  $key: " . var_export($value, true) . "\n";
    }
}

echo "\n=== KORREKTE DATENSTRUKTUR FÜR HTML ===\n";

// Show what the HTML code expects vs what we provide
echo "HTML erwartet:\n";
echo "  - name (string)\n";
echo "  - quantity (int)\n";
echo "  - revenue (int, in Cent)\n";
echo "  - avg_price (int, in Cent)\n\n";

echo "Parser liefert (product_performance):\n";
if (isset($productReport['product_performance'][0])) {
    foreach ($productReport['product_performance'][0] as $key => $value) {
        echo "  - $key (" . gettype($value) . ")\n";
    }
}

echo "\n=== LÖSUNG ===\n";
echo "Das HTML muss angepasst werden oder wir brauchen eine Mapping-Funktion.\n";

echo "\n=== ANGEPASSTE DATEN FÜR HTML ===\n";

// Create mapped data for HTML
$mappedProductReport = [];
foreach ($productReport['product_performance'] as $product) {
    $mappedProductReport[] = [
        'name' => $product['name'],
        'quantity' => (int)$product['total_quantity_sold'],
        'revenue' => (int)($product['total_revenue'] * 100), // Convert to Cent
        'avg_price' => (int)($product['price'] * 100) // Convert to Cent
    ];
}

echo "Gemappte Daten (erste 3):\n";
for ($i = 0; $i < min(3, count($mappedProductReport)); $i++) {
    $product = $mappedProductReport[$i];
    echo "Produkt $i:\n";
    foreach ($product as $key => $value) {
        echo "  $key: " . var_export($value, true) . "\n";
    }
    echo "\n";
}

echo "=== ENDE ===\n";
