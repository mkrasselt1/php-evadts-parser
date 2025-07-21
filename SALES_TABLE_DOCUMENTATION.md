# Sales Table Function Documentation

## Übersicht

Die `Report` Klasse bietet zwei neue Funktionen zur Analyse von EVA DTS-Verkaufsdaten:

1. **`generateSalesTable()`** - Gibt strukturierte Array-Daten zurück
2. **`generateSalesTableString()`** - Gibt formatierte Konsolen-Tabellen als String zurück

## Neue ConsoleTable Klasse

Eine eigenständige Klasse für die Formatierung von Konsolen-Tabellen wurde hinzugefügt (`ConsoleTable.php`):

```php
$table = new ConsoleTable();
$table->setHeaders(['Header1', 'Header2'])
      ->addRow(['Value1', 'Value2'])
      ->addRows([
          ['Row1Col1', 'Row1Col2'],
          ['Row2Col1', 'Row2Col2']
      ]);

echo $table->render('Table Title');
```

## CLI-Tool

Ein Kommandozeilen-Tool wurde hinzugefügt (`bin/sales_report.php`):

```bash
# Tabellen-Format (Standard)
php bin/sales_report.php example/animo.eva_dts

# JSON-Format
php bin/sales_report.php --format=json example/animo.eva_dts

# Beide Formate
php bin/sales_report.php --format=both example/animo.eva_dts

# Hilfe anzeigen
php bin/sales_report.php --help
```

## Verwendung

### Array-Daten abrufen

```php
<?php
use PeanutPay\PhpEvaDts\Parser;

$parser = new Parser();
if ($parser->load('your-file.eva_dts')) {
    $report = $parser->getReport();
    
    // Strukturierte Array-Daten
    $salesTable = $report->generateSalesTable();
    
    // Ausgabe als JSON
    echo json_encode($salesTable, JSON_PRETTY_PRINT);
}
?>
```

### Formatierte Konsolen-Ausgabe

```php
<?php
use PeanutPay\PhpEvaDts\Parser;

$parser = new Parser();
if ($parser->load('your-file.eva_dts')) {
    $report = $parser->getReport();
    
    // Formatierte Tabellen-Ausgabe
    echo $report->generateSalesTableString();
}
?>
```

## Rückgabe-Struktur

Die Funktion gibt ein assoziatives Array mit folgender Struktur zurück:

```php
[
    'pricelists' => [
        [
            'pricelist_id' => int,           // ID der Preisliste
            'products' => [
                [
                    'product_number' => int,      // Produktnummer
                    'name' => string,            // Produktname
                    'price' => float,            // Preis in Währungseinheiten
                    'active' => bool,            // Ob das Produkt aktiv ist
                    'number_paid_init' => int,   // Anfangszähler bezahlte Verkäufe
                    'number_paid_reset' => int,  // Reset-Zähler bezahlte Verkäufe
                    'total_sales_amount' => int, // Gesamtanzahl Verkäufe
                    'total_sales_value' => float // Gesamtwert der Verkäufe
                ],
                // ... weitere Produkte
            ],
            'total_products' => int          // Anzahl Produkte in dieser Preisliste
        ],
        // ... weitere Preislisten
    ],
    'products' => [
        [
            'product_number' => int,    // Produktnummer
            'name' => string,          // Produktname
            'price' => float,          // Preis in Währungseinheiten
            'active' => bool,          // Ob das Produkt aktiv ist
            'sales_amount' => int,     // Gesamtanzahl Verkäufe über alle Preislisten
            'sales_value' => float     // Gesamtwert der Verkäufe über alle Preislisten
        ],
        // ... weitere Produkte
    ],
    'summary' => [
        'total_pricelists' => int,     // Gesamtanzahl Preislisten
        'total_products' => int,       // Gesamtanzahl Produkte
        'total_sales_amount' => int,   // Gesamtanzahl aller Verkäufe
        'total_sales_value' => float   // Gesamtwert aller Verkäufe
    ]
]
```

## Funktionsweise

1. **Datenextraktion**: Die Funktion durchsucht alle Data-Blocks nach:
   - `PriceListVendsDataBlock` (LA1) - Preislisten-Daten
   - `ProductDataBlock` (PA1) - Produktinformationen
   - `ProductVendsDataBlock` (PA2) - Verkaufsdaten

2. **Preiskonvertierung**: Alle Preise werden von Cent in Währungseinheiten umgerechnet (Division durch 100)

3. **Datenverknüpfung**: Produktdaten werden mit Preislisten-Daten verknüpft über die Produktnummer

4. **Verkaufsberechnung**: 
   - `total_sales_amount = number_paid_reset - number_paid_init`
   - `total_sales_value = total_sales_amount * price`

## Hinweise

- Preise werden automatisch von Cent in Währungseinheiten konvertiert
- Unbekannte Produkte (ohne PA1-Block) werden als "Unknown Product" markiert
- Die Funktion ist sicher gegen fehlende oder leere Data-Blocks
- Negative Verkaufswerte können auf Rückerstattungen oder Fehler hindeuten

## Beispielausgabe

Siehe `example/sales_table_example.php` für ein vollständiges Beispiel der Verwendung.
