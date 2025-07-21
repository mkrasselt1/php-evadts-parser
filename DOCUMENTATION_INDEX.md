# Documentation Index

This document provides an overview of all available documentation for the PHP EVA DTS Parser project.

## 📚 Documentation Files

### Core Documentation

1. **[README.md](README.md)** - Main project overview and quick start guide
   - Installation instructions
   - Basic usage examples
   - CLI tool usage
   - Feature overview

2. **[API_DOCUMENTATION.md](API_DOCUMENTATION.md)** - Complete API reference
   - Core classes (Parser, Report, ConsoleTable)
   - Method signatures and examples
   - Data structure reference
   - Advanced usage patterns

3. **[DATA_BLOCKS_REFERENCE.md](DATA_BLOCKS_REFERENCE.md)** - EVA DTS data block specifications
   - Complete data block type listing
   - Field mappings and data types
   - Usage examples for each block type
   - Block type mapping table

4. **[SALES_TABLE_DOCUMENTATION.md](SALES_TABLE_DOCUMENTATION.md)** - Sales analysis features
   - Sales table generation
   - Console table formatting
   - CLI tool documentation
   - Output format specifications

## 🏗️ Architecture Overview

### Core Classes

```
Parser
├── load(string $fileName): bool
├── parse(string $content): bool
└── getReport(): ?Report

Report
├── add(DataBlockInterface $block): void
├── generateSalesTable(): array
├── generateSalesTableString(): string
└── __toString(): string

ConsoleTable
├── setHeaders(array $headers): ConsoleTable
├── addRow(array $row): ConsoleTable
├── addRows(array $rows): ConsoleTable
└── render(string $title): string
```

### Data Block Hierarchy

```
DataBlockInterface
└── DataBlock (abstract base)
    ├── ProductDataBlock (PA1)
    ├── PriceListVendsDataBlock (LA1)
    ├── ProductVendsDataBlock (PA2)
    ├── VMCIDDataBlock (ID1)
    ├── CoinVendsDataBlock (CA2)
    ├── EventDataBlock (EA1)
    └── ... (40+ data block types)
```

## 🚀 Quick Start Guide

### 1. Basic File Parsing

```php
use PeanutPay\PhpEvaDts\Parser;

$parser = new Parser();
if ($parser->load('machine.eva_dts')) {
    $report = $parser->getReport();
    echo $report->generateSalesTableString();
}
```

### 2. Sales Analysis

```php
$salesData = $report->generateSalesTable();

// Access summary data
echo "Total Revenue: €" . number_format($salesData['summary']['total_sales_value'], 2);

// Access product data
foreach ($salesData['products'] as $product) {
    echo "Product: {$product['name']} - Sales: {$product['sales_amount']} units\n";
}
```

### 3. CLI Usage

```bash
# Basic report
php bin/sales_report.php example/animo.eva_dts

# JSON output
php bin/sales_report.php --format=json example/animo.eva_dts
```

## 📊 Data Flow

```
EVA DTS File
    ↓
Parser::load()
    ↓
DataBlock::create() → Specific DataBlock instances
    ↓
Report::add() → Collection of DataBlocks
    ↓
Report::generateSalesTable() → Structured analysis
    ↓
Report::generateSalesTableString() → Formatted output
```

## 🎯 Use Cases

### 1. **Sales Reporting**
- Generate daily/weekly/monthly sales reports
- Analyze product performance
- Track revenue and transaction counts

### 2. **Inventory Management**
- Monitor product availability
- Track stock levels through sales data
- Identify popular products

### 3. **Machine Monitoring**
- Parse machine status and events
- Monitor hardware health
- Track maintenance requirements

### 4. **Financial Analysis**
- Calculate revenue by product/time period
- Analyze payment method usage
- Track discount and promotion effectiveness

## 🛠️ Extension Points

### Custom Data Blocks

```php
class CustomDataBlock extends DataBlock {
    const ASSIGNMENT = [
        0 => "",
        1 => "customField1",
        2 => "customField2"
    ];
    
    public $customField1 = "";
    public $customField2 = "";
}
```

### Custom Analysis

```php
class CustomReport extends Report {
    public function generateCustomAnalysis(): array {
        // Your custom analysis logic
        return $analysisData;
    }
}
```

## 📝 Code Examples

### Example Files Location

- `example/sales_table_example.php` - Basic sales analysis
- `example/formatted_sales_table_example.php` - Console output
- `bin/sales_report.php` - Complete CLI tool

### Sample Data Files

- `example/animo.eva_dts` - Coffee machine data
- `example/sielaff.eva_dts` - Snack machine data
- `example/rhevendors.eva_dts` - Multi-vendor data

## 🔧 Development

### Adding New Data Block Types

1. Create new class extending `DataBlock`
2. Define `ASSIGNMENT` constant for field mapping
3. Add properties for data fields
4. Add class mapping in `DataBlock::create()`

### Testing

```bash
php example/sales_table_example.php
php bin/sales_report.php example/animo.eva_dts
```

## 📋 Checklists

### For Users

- [ ] Read [README.md](README.md) for basic setup
- [ ] Try CLI tool with sample data
- [ ] Review [API_DOCUMENTATION.md](API_DOCUMENTATION.md) for advanced usage
- [ ] Check [DATA_BLOCKS_REFERENCE.md](DATA_BLOCKS_REFERENCE.md) for specific data types

### For Developers

- [ ] Study architecture in [API_DOCUMENTATION.md](API_DOCUMENTATION.md)
- [ ] Review data block structure in [DATA_BLOCKS_REFERENCE.md](DATA_BLOCKS_REFERENCE.md)
- [ ] Examine example implementations
- [ ] Test with provided sample files

## 🆘 Support

### Common Issues

1. **File not parsing**: Check EVA DTS format and file encoding
2. **Missing data**: Verify data block types are supported
3. **Incorrect sales data**: Check counter logic and field mappings

### Getting Help

1. Check existing documentation
2. Review example files
3. Test with provided sample data
4. Contact maintainer: michael@peanutpay.de

---

**Last Updated:** July 2025  
**Version:** 1.1.0  
**Maintainer:** Michael Krasselt <michael@peanutpay.de>
