# EVA-DTS Parser Examples

Dieser Ordner enthält Beispieldateien und Tests für den EVA-DTS Parser.

## 📁 Beispieldateien (EVA-DTS Daten)

### Kaffeemaschinen-Daten:
- `2025-06-18-11-27-ACTECH LUCE Zero.0 Bohne 2.txt` - ACTECH Kaffeeautomat (Reset-Situation)
- `2025-06-20-13-46-Hewa Luce 1 #39 Links.txt` - Hewa Luce Kaffeeautomat (hohe Verkaufszahlen)
- `2025-01-22-15-27-ACTECH Snack.txt` - ACTECH Snackautomat
- `2025-07-07-10-05-Hewa Snack 1#38.txt` - Hewa Snackautomat

### Andere Vendingmaschinen:
- `2024-02-05-11-32-IMM Mitweida.eva.txt` - IMM Vendingmaschine
- `2024-06-05-15-16-Hewa Snack 138.txt` - Hewa Snack-Automat
- `2024-11-27-15-00-Batch 2 - 17 PPHQ.txt` - Batch-Export
- `animo.eva_dts`, `animo2.eva_dts` - Animo Maschinen
- `rhevendors.eva_dts` - RHE Vendors Maschine
- `sielaff.eva_dts` - Sielaff Automat

## 🧪 Test- und Analyseskripte

### Haupt-Tests:
- **`test_all_parser_methods.php`** - Vollständiger Test aller Parser-Methoden
  - Testet alle 9 Parser-Methoden (getTables, getSalesData, etc.)
  - Zeigt Performance-Metriken
  - Analysiert Datenblock-Typen

### Detailanalysen:
- **`detailed_file_analysis.php`** - Detaillierte Analyse einer spezifischen Datei
  - Verkaufsdaten-Aufschlüsselung
  - Produktanalyse mit Preisen
  - Cashbox- und Event-Auswertung

- **`data_structure_analysis.php`** - Analyse der Datenstrukturen
  - Vergleich Parser-Ausgabe vs. erwartete HTML-Formate
  - Mapping-Probleme identifizieren
  - Lösungsvorschläge für Template-Integration

- **`issue_analysis.php`** - Problemdiagnose bei leeren Reports
  - Reset-Situationen erkennen
  - Negative Werte analysieren
  - Datenintegrität prüfen

### Kompatibilitäts-Tests:
- **`legacy_compatibility_test.php`** - Test der Legacy-Kompatibilität
  - `getProductReportLegacy()` Funktion testen
  - Rückwärtskompatibilität für alte HTML-Templates

- **`validation_test.php`** - Finale Validierung aller Funktionen
  - Kompakter Test der wichtigsten Features
  - Zusammenfassung der Ergebnisse

## 🌐 HTML Template Beispiele

- **`html_template_example.html`** - Korrigiertes HTML-Template für Produktreports
  - Verwendet moderne Parser-Ausgabe
  - Zusätzliche Statistiken und Kategorieanalyse
  - Bootstrap-kompatibles Layout

## 📊 Alte Beispiele (bereits vorhanden)

- `formatted_sales_table_example.php` - Formatierte Verkaufstabelle
- `sales_table_example.php` - Einfache Verkaufstabelle
- `test.php` - Basis-Test

## 🚀 Verwendung

### Alle Parser-Methoden testen:
```bash
cd example/
php test_all_parser_methods.php
```

### Spezifische Datei analysieren:
```bash
# Datei in detailed_file_analysis.php ändern, dann:
php detailed_file_analysis.php
```

### Legacy-Kompatibilität prüfen:
```bash
php legacy_compatibility_test.php
```

### Datenstrukturen verstehen:
```bash
php data_structure_analysis.php
```

## 📝 Hinweise

- **Reset-Situationen**: Viele Dateien enthalten Reset-Situationen (Reset-Zähler = 0)
- **Preiskonvertierung**: Preise in EVA-DTS sind in Cent, Parser konvertiert zu Euro
- **Negative Werte**: Bei Reset-Situationen können negative Differenzen auftreten
- **Performance**: Alle Parser-Methoden sind optimiert und laufen in < 1ms

## 🔧 Anpassungen

Zum Testen anderer Dateien:
1. Gewünschte Testdatei in den entsprechenden PHP-Skripten anpassen
2. `$testFile` Variable am Anfang der Datei ändern
3. Skript ausführen

Beispiel:
```php
$testFile = __DIR__ . '/2025-06-20-13-46-Hewa Luce 1 #39 Links.txt';
```
