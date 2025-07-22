<?php

require_once __DIR__ . '/vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

// Test file
$testFile = __DIR__ . '/example/2025-06-20-13-46-Hewa Luce 1 #39 Links.txt';

echo "=== CA14 FIELD ANALYSIS ===\n";

// Create parser and load file
$parser = new Parser();
$parser->load($testFile);

echo "CA14 ASSIGNMENT Array aus CoinAcceptedDataBlock:\n";
echo "0 => \"\" (Block-ID)\n";
echo "1 => \"coinValue\" (Münzwert)\n";
echo "2 => \"amountInLastReset\" (Menge seit letztem Reset)\n";
echo "3 => \"amount2CashboxLastReset\" (Menge zur Cashbox seit Reset)\n";
echo "4 => \"amount2TubeLastReset\" (Menge zum Tube seit Reset)\n";
echo "5 => \"amountInInit\" (Menge seit Initialisierung)\n";
echo "6 => \"amount2CashboxInit\" (Menge zur Cashbox seit Init)\n";
echo "7 => \"amount2TubeInit\" (Menge zum Tube seit Init)\n\n";

echo "=== ROHDATEN ANALYSE ===\n";
$content = file_get_contents($testFile);
$lines = explode("\n", $content);

foreach ($lines as $lineNum => $line) {
    if (strpos($line, 'CA14*') === 0) {
        $parts = explode('*', trim($line));
        echo "Zeile " . ($lineNum + 1) . ": " . trim($line) . "\n";
        echo "  Field 0 (Block): " . ($parts[0] ?? 'N/A') . "\n";
        echo "  Field 1 (coinValue): " . ($parts[1] ?? 'N/A') . " Cent\n";
        echo "  Field 2 (amountInLastReset): " . ($parts[2] ?? 'N/A') . "\n";
        echo "  Field 3 (amount2CashboxLastReset): " . ($parts[3] ?? 'N/A') . "\n";
        echo "  Field 4 (amount2TubeLastReset): " . ($parts[4] ?? 'N/A') . "\n";
        echo "  Field 5 (amountInInit): " . ($parts[5] ?? 'N/A') . "\n\n";
    }
}

echo "=== PARSED COINACCEPTEDDATABLOCK OBJECTS ===\n";
$report = $parser->getReport();
$blocks = $report->getBlocks();

foreach ($blocks as $block) {
    if ($block instanceof \PeanutPay\PhpEvaDts\CoinAcceptedDataBlock) {
        echo "CoinAcceptedDataBlock:\n";
        echo "  coinValue: " . $block->coinValue . " Cent (" . ($block->coinValue / 100) . " EUR)\n";
        echo "  amountInLastReset: " . $block->amountInLastReset . "\n";
        echo "  amount2CashboxLastReset: " . $block->amount2CashboxLastReset . "\n";
        echo "  amount2TubeLastReset: " . $block->amount2TubeLastReset . "\n";
        echo "  amountInInit: " . $block->amountInInit . "\n";
        echo "  amount2CashboxInit: " . $block->amount2CashboxInit . "\n";
        echo "  amount2TubeInit: " . $block->amount2TubeInit . "\n";
        echo "\n";
    }
}

echo "=== MEINE INTERPRETATION DER FELDER ===\n";
echo "Basierend auf den Daten CA14*500*88*88*88*88:\n\n";

echo "Field 1 (coinValue = 500): Münzwert in Cent = 5 Cent Münze ✅\n";
echo "Field 2 (amountInLastReset = 88): ?\n";
echo "Field 3 (amount2CashboxLastReset = 88): ?\n";
echo "Field 4 (amount2TubeLastReset = 88): ?\n";
echo "Field 5 (amountInInit = 88): ?\n\n";

echo "HYPOTHESEN:\n";
echo "1. Alle Felder 2-5 sind identisch (88) - das ist ungewöhnlich für separate Zähler\n";
echo "2. Mögliche Bedeutungen:\n";
echo "   a) Tube-Level: Aktueller Bestand von 5-Cent Münzen im Wechselgeld-Rohr\n";
echo "   b) Accepted: Gesamtanzahl akzeptierter 5-Cent Münzen seit Init/Reset\n";
echo "   c) Redundanz: Verschiedene Backup-Zähler für Sicherheit\n";
echo "   d) Status-Codes: Alle 88 könnte ein Status-Code sein\n\n";

echo "3. Problem in getCashboxData():\n";
echo "   totalAccepted = amountInLastReset - amountInInit = 88 - 88 = 0\n";
echo "   Das erklärt, warum total_accepted = 0 ist!\n\n";

echo "4. Mögliche Lösungsansätze:\n";
echo "   a) CA14 Format ist anders als erwartet - andere DataBlock-Klasse verwenden\n";
echo "   b) Interpretation ändern: 88 = aktueller Bestand, nicht Differenz\n";
echo "   c) CA14 mappt auf CoinTubeLevelDataBlock statt CoinAcceptedDataBlock\n";
