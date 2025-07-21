<?php

require_once __DIR__ . '/vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

$testFile = __DIR__ . '/example/2025-06-20-13-46-Hewa Luce 1 #39 Links.txt';

echo "=== TEST LEGACY PRODUCT REPORT ===\n\n";

$parser = new Parser();
$parser->load($testFile);

// Test the new legacy function
echo "Legacy Product Report:\n";
$legacyReport = $parser->getProductReportLegacy();

foreach (array_slice($legacyReport, 0, 5) as $i => $product) {
    echo "Produkt $i:\n";
    echo "  Name: {$product['name']}\n";
    echo "  Quantity: {$product['quantity']}\n";
    echo "  Revenue: " . number_format($product['revenue'] / 100, 2) . "€ (Original: {$product['revenue']} Cent)\n";
    echo "  Avg Price: " . number_format($product['avg_price'] / 100, 2) . "€ (Original: {$product['avg_price']} Cent)\n";
    echo "\n";
}

echo "=== BEISPIEL HTML TEMPLATE MIT LEGACY DATEN ===\n";
echo '<?php $productReport = $parser->getProductReportLegacy(); ?>' . "\n";
echo '<!-- Jetzt funktioniert das ursprüngliche HTML Template: -->' . "\n";
echo '<table class="table table-striped">' . "\n";
foreach (array_slice($legacyReport, 0, 3) as $product) {
    echo '    <tr>' . "\n";
    echo '        <td>' . htmlspecialchars($product['name']) . '</td>' . "\n";
    echo '        <td>' . $product['quantity'] . '</td>' . "\n";
    echo '        <td>' . number_format($product['revenue'] / 100, 2, ',', '.') . ' €</td>' . "\n";
    echo '        <td>' . number_format($product['avg_price'] / 100, 2, ',', '.') . ' €</td>' . "\n";
    echo '    </tr>' . "\n";
}
echo '</table>' . "\n";

echo "\n=== TEST COMPLETED ===\n";
