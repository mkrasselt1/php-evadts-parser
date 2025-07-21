# PHP EVA DTS Parser - API Documentation

## Overview

This PHP library parses EVA DTS (Electronic Vending Audit Data Transfer Standard) files from vending machines. It provides structured access to sales data, product information, audit records, and various machine telemetry data.

## Table of Contents

1. [Core Classes](#core-classes)
2. [Data Block Classes](#data-block-classes)
3. [Usage Examples](#usage-examples)
4. [Data Structure Reference](#data-structure-reference)

---

## Core Classes

### Parser

The main entry point for parsing EVA DTS files.

**Methods:**

```php
// Load and parse from file
public function load(string $fileName): bool

// Parse from string content
public function parse(string $fileContent): bool

// Get the parsed report
public function getReport(): ?Report
```

**Example:**
```php
$parser = new Parser();
if ($parser->load('machine_data.eva_dts')) {
    $report = $parser->getReport();
    // Process report...
}
```

### Report

Container for all parsed data blocks with analysis capabilities.

**Methods:**

```php
// Add a data block to the report
public function add(DataBlockInterface $newBlock): void

// Generate structured sales analysis
public function generateSalesTable(): array

// Generate formatted console output
public function generateSalesTableString(): string

// Convert to string representation
public function __toString(): string
```

**Sales Table Structure:**
```php
[
    'pricelists' => [
        [
            'pricelist_id' => int,
            'products' => [...],
            'total_products' => int
        ]
    ],
    'products' => [
        [
            'product_number' => int,
            'name' => string,
            'price' => float,
            'active' => bool,
            'sales_amount' => int,
            'sales_value' => float
        ]
    ],
    'summary' => [
        'total_pricelists' => int,
        'total_products' => int,
        'total_sales_amount' => int,
        'total_sales_value' => float
    ]
]
```

### ConsoleTable

Utility class for formatting tabular data in console output.

**Methods:**

```php
// Set table headers
public function setHeaders(array $headers): ConsoleTable

// Add a single row
public function addRow(array $row): ConsoleTable

// Add multiple rows
public function addRows(array $rows): ConsoleTable

// Render table with optional title
public function render(string $title = ''): string
```

**Example:**
```php
$table = new ConsoleTable();
$table->setHeaders(['Product', 'Sales', 'Value'])
      ->addRow(['Coffee', '150', '€150.00'])
      ->addRow(['Tea', '89', '€89.00']);
echo $table->render('Sales Report');
```

---

## Data Block Classes

All data block classes implement `DataBlockInterface` and extend `DataBlock`.

### Product Information

#### ProductDataBlock (PA1)
Contains product definitions and configuration.

**Properties:**
- `$productNumber` (int) - Product identifier
- `$name` (string) - Product name
- `$price` (int) - Price in cents
- `$active` (bool) - Whether product is available

#### PriceListVendsDataBlock (LA1)
Contains price list and sales counter data.

**Properties:**
- `$priceList` (int) - Price list identifier
- `$productNumber` (int) - Product identifier
- `$price` (int) - Price in cents
- `$numberPaidInit` (int) - Initial paid counter
- `$numberPaidReset` (int) - Reset paid counter

### Sales Data

#### ProductVendsDataBlock (PA2)
Aggregate sales data for all products.

**Properties:**
- `$numberProductsInit` (int) - Initial products sold count
- `$valueProductsInit` (int) - Initial products sold value (cents)
- `$numberProductsReset` (int) - Reset products sold count
- `$valueProductsReset` (int) - Reset products sold value (cents)
- `$numberDiscountsInit` (int) - Initial discount count
- `$valueDiscountsInit` (int) - Initial discount value (cents)
- `$numberDiscountsReset` (int) - Reset discount count
- `$valueDiscountsReset` (int) - Reset discount value (cents)

#### ProductTestVendsDataBlock (PA3)
Test vend data for products.

#### ProductFreeVendsDataBlock (PA4)
Free vend data for products.

### Machine Information

#### VMCIDDataBlock (ID1)
Vending Machine Controller identification.

**Properties:**
- Machine serial number
- Software version
- Hardware configuration

#### MachineDataBlock (MA5)
General machine information and settings.

#### TimeDataBlock (ID5)
Machine time and date information.

**Properties:**
- Current machine date/time
- Time zone information

### Payment Systems

#### CoinIDDataBlock (CA1)
Coin mechanism identification and configuration.

#### CoinVendsDataBlock (CA2)
Coin-based transaction data.

#### CashlessIDDataBlock (DA1)
Cashless payment system identification.

#### CashlessVendsDataBlock (DA2)
Cashless transaction data.

### Audit and Events

#### EventDataBlock (EA1)
System events and alerts.

#### EventDetailsDataBlock (EA2)
Detailed event information.

#### AuditModuleDataBlock (AM1)
Audit trail information.

---

## Usage Examples

### Basic File Parsing

```php
use PeanutPay\PhpEvaDts\Parser;

$parser = new Parser();
if ($parser->load('/path/to/machine.eva_dts')) {
    $report = $parser->getReport();
    
    // Get formatted sales report
    echo $report->generateSalesTableString();
    
    // Get raw data for processing
    $salesData = $report->generateSalesTable();
    
    // Access individual blocks
    foreach ($report->blocks as $block) {
        if ($block instanceof ProductDataBlock) {
            echo "Product: {$block->name} - Price: {$block->price}\n";
        }
    }
}
```

### Sales Analysis

```php
$salesTable = $report->generateSalesTable();

// Total revenue
$totalRevenue = $salesTable['summary']['total_sales_value'];

// Best selling products
usort($salesTable['products'], function($a, $b) {
    return $b['sales_amount'] <=> $a['sales_amount'];
});

$topProduct = $salesTable['products'][0];
echo "Top seller: {$topProduct['name']} ({$topProduct['sales_amount']} units)";
```

### CLI Usage

```bash
# Generate table report
php bin/sales_report.php machine_data.eva_dts

# Generate JSON output
php bin/sales_report.php --format=json machine_data.eva_dts

# Generate both formats
php bin/sales_report.php --format=both machine_data.eva_dts
```

---

## Data Structure Reference

### EVA DTS Block Types

| Code | Class | Description |
|------|-------|-------------|
| ID1 | VMCIDDataBlock | VMC Identification |
| ID4 | CurrencyDataBlock | Currency Information |
| ID5 | TimeDataBlock | Date/Time Information |
| ID6 | CashBagDataBlock | Cash Collection Data |
| PA1 | ProductDataBlock | Product Definitions |
| PA2 | ProductVendsDataBlock | Product Sales Data |
| PA3 | ProductTestVendsDataBlock | Test Vend Data |
| PA4 | ProductFreeVendsDataBlock | Free Vend Data |
| PA7 | ProductVendsNewDataBlock | New Product Sales Format |
| LA1 | PriceListVendsDataBlock | Price List Data |
| CA1 | CoinIDDataBlock | Coin Mechanism ID |
| CA2 | CoinVendsDataBlock | Coin Sales Data |
| CA3 | CashReportDataBlock | Cash Report |
| DA1 | CashlessIDDataBlock | Cashless System ID |
| DA2 | CashlessVendsDataBlock | Cashless Sales Data |
| EA1 | EventDataBlock | System Events |
| EA2 | EventDetailsDataBlock | Event Details |
| MA5 | MachineDataBlock | Machine Information |

### Common Properties

Most data blocks share these common properties:

- **Timestamps**: Usually in YYYYMMDD or YYYYMMDDHHMMSS format
- **Counters**: Initial and reset values for tracking changes
- **Monetary Values**: Stored in cents/smallest currency unit
- **Status Flags**: Boolean indicators for various states

### Error Handling

```php
try {
    $parser = new Parser();
    if (!$parser->load($filename)) {
        throw new Exception("Failed to parse EVA DTS file");
    }
    $report = $parser->getReport();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

---

## License

This library is licensed under the same terms as the original project.
