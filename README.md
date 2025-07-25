# PHP EVA DTS Parser

A comprehensive PHP library for parsing EVA DTS (Electronic Vending Audit Data Transfer Standard) files from vending machines. This library converts machine audit data into structured, analyzable formats with built-in sales analysis and reporting capabilities.

## Features

- ✅ **Complete EVA DTS 6.1.2 Support** - Parses all 115+ documented data block field types
- ✅ **93 DataBlock Classes** - Comprehensive coverage including specialty blocks (CA15-CA24, DA7, EA250705, EADXS)
- ✅ **Sales Analysis** - Built-in sales reporting and analysis functions with 9 core parser methods
- ✅ **Console Table Output** - Professional formatted table output for reports
- ✅ **CLI Tool** - Command-line interface for quick analysis
- ✅ **Extensible Architecture** - Easy to extend for custom data block types
- ✅ **Well Documented** - Comprehensive API documentation and examples
- ✅ **Organized Structure** - Clean separation of production code, tests, and examples

## Quick Start

### Basic Usage

```php
<?php
require_once 'vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

// Parse an EVA DTS file
$parser = new Parser();
if ($parser->load('machine_data.eva_dts')) {
    $report = $parser->getReport();
    
    // Get formatted sales report
    echo $report->generateSalesTableString();
    
    // Get structured data for analysis
    $salesData = $report->generateSalesTable();
}
?>
```

### CLI Tool

```bash
# Generate formatted table report
php bin/sales_report.php example/animo.eva_dts

# Generate JSON output
php bin/sales_report.php --format=json example/animo.eva_dts

# Show help
php bin/sales_report.php --help
```

### Advanced Usage with New Parser Methods

```php
<?php
use PeanutPay\PhpEvaDts\Parser;

$parser = new Parser();
$parser->load('machine_data.eva_dts');

// Get all data tables at once
$tables = $parser->getTables();

// Individual data extraction
$salesData = $parser->getSalesData();       // Sales transactions
$productData = $parser->getProductData();   // Product information
$cashboxData = $parser->getCashboxData();   // Cash/coin management
$auditData = $parser->getAuditData();       // System audit trail
$eventData = $parser->getEventData();       // Events and errors

// Generate comprehensive reports
$salesReport = $parser->generateSalesReport();     // Sales analysis
$productReport = $parser->generateProductReport(); // Product performance
$errorReport = $parser->getErrorReport();          // Data validation

// Legacy compatibility for old templates
$legacyFormat = $parser->getProductReportLegacy();
?>
```

## 📁 Project Structure

```
src/              # Production DataBlock classes (93 classes covering all EVA-DTS fields)
test/             # Test scripts, validation tools, and development utilities  
example/          # Sample EVA-DTS files from various vending machine types
bin/              # CLI tools (sales_report.php)
docs/             # API documentation and field references
```

## 🧪 Testing and Validation

The `test/` directory contains comprehensive testing and validation tools:

- **test_all_reports.php** - Complete parser method testing and validation
- **validate_all_fields.php** - EVA-DTS 6.1.2 field coverage validation
- **debug_*.php** - Debugging tools for specific data types
- **coverage_analysis.php** - Field coverage analysis and reporting

```bash
# Test all parser methods with comprehensive validation
php test/test_all_reports.php

# Validate complete field coverage
php test/validate_all_fields.php

# Run specific validation tests
php test/comprehensive_test.php
```

## 📄 Sample Data

The `example/` directory contains real EVA-DTS files from various manufacturers:

- **Animo** coffee machines (.eva_dts format)
- **Sielaff** snack machines (.eva_dts format) 
- **Hewa** combination machines (.txt format)
- **ACTECH** modern machines (.txt format)
- **Rhevendors** legacy systems (.eva_dts format)

## Installation

Make sure you have [Composer](https://getcomposer.org/) installed. Then, require the package in your project:

```bash
composer require peanutpay/php-evadts-parser
```

## Usage

Here's an example of how to use the parser:

```php
require_once __DIR__ . '/../vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

$parser = new Parser();

// Load an EvaDTS file
$parser->load(__DIR__ . "/rhevendors.eva_dts");

// Output the parsed report
echo $parser->getReport();
```

## Supported Data Blocks

This parser supports **all 115 documented EVA DTS 6.1.2 field identifiers** with 93 specialized DataBlock classes:

### Core Data Blocks (Complete Coverage)
- **Product Data** (PA1-PA8) - Product definitions, sales, test vends, free vends
- **Price Lists** (LA1) - Product pricing and sales counters  
- **Machine Info** (ID1, ID4, ID5, ID6, MA5) - Machine identification and configuration
- **Vend Counters** (VA1-VA3) - Paid, test, and free vend totals

### Payment Systems (All Variants)
- **Coin Systems** (CA1-CA24) - Complete coin management including tube levels, audit, dispensing
- **Bill Systems** (BA1-BA4) - Bill acceptor identification and management
- **Cashless Systems** (DA1-DA7) - Card payment systems, transactions, and specialty blocks

### Events & Audit (Comprehensive)
- **Events** (EA1-EA7, EA250705) - System events, alarms, maintenance records, specialty events
- **Audit Data** (AM1, TA1-TA5, SA1-SA2) - Complete audit trails and time management
- **Control & Status** (CB1, ST, DXS, EADXS, DXE) - System status and data exchange

### Extended & Device-Specific (Full Support)
- **Database Blocks** (DB1-DB10) - Device-specific data and configurations
- **Position Data** (PP1) - Product positioning information
- **System Data** (SD1, G85, SE, VM1) - Configuration and session management
- **Specialty Blocks** - All manufacturer-specific and proprietary block types

**93 DataBlock classes** covering **115+ unique field identifiers** with full EVA DTS 6.1.2 specification compliance.

## Notes

- ✅ **Production Ready** - Complete EVA DTS 6.1.2 specification coverage with 115+ field identifiers
- ✅ **Comprehensive** - 93 DataBlock classes handle data from all major vending machine manufacturers
- ✅ **Extensible** - Easy to add support for new or proprietary data block types
- ✅ **Well Tested** - Extensive test suite with real-world EVA DTS files from various machines
- ✅ **Clean Architecture** - Organized structure separating production code, tests, and examples
- ✅ **Specialty Support** - Handles unknown blocks, legacy formats, and manufacturer-specific extensions

## Development and Testing

This project uses custom test scripts rather than traditional PHP testing frameworks for several reasons:

1. **Domain-Specific Testing** - EVA DTS parsing requires specialized validation of binary data formats
2. **Real-World Data Focus** - Tests use actual vending machine files rather than mocked data
3. **Visual Output Requirements** - Console table formatting and HTML report generation need visual validation
4. **Rapid Prototyping** - Custom scripts allow quick iteration during EVA DTS specification development
5. **Integration Testing** - End-to-end parser validation with complete data flows

The test suite in `test/` provides comprehensive coverage including field validation, error handling, and format compliance testing.

## Contributing

Feel free to fork this repository and submit pull requests. Contributions are welcome!

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
