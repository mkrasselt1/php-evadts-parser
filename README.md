# PHP EVA DTS Parser

A comprehensive PHP library for parsing EVA DTS (Electronic Vending Audit Data Transfer Standard) files from vending machines. This library converts machine audit data into structured, analyzable formats with built-in sales analysis and reporting capabilities.

## Features

- ✅ **Complete EVA DTS Support** - Parses all standard EVA DTS data block types
- ✅ **Sales Analysis** - Built-in sales reporting and analysis functions
- ✅ **Console Table Output** - Professional formatted table output for reports
- ✅ **CLI Tool** - Command-line interface for quick analysis
- ✅ **Extensible Architecture** - Easy to extend for custom data block types
- ✅ **Well Documented** - Comprehensive API documentation and examples

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

This parser now supports **all** standard EVA DTS data block types, including:

### Core Data Blocks
- **Product Data** (PA1-PA8) - Product definitions, sales, test vends, free vends
- **Price Lists** (LA1) - Product pricing and sales counters
- **Machine Info** (ID1, ID4, ID5, ID6, MA5) - Machine identification and configuration
- **Vend Counters** (VA1-VA3) - Paid, test, and free vend totals

### Payment Systems
- **Coin Systems** (CA1-CA17) - Coin acceptor, dispensing, tube levels, audit data
- **Bill Systems** (BA1) - Bill acceptor identification
- **Cashless Systems** (DA1, DA2, DA5) - Card payment systems and transactions

### Events & Audit
- **Events** (EA1-EA7) - System events, alarms, maintenance records
- **Audit Data** (AM1, TA2, TA3, TA5, SA2) - Comprehensive audit trails
- **Control & Status** (CB1, ST, DXS, DXE) - System status and data exchange

### Extended & Device-Specific
- **Database Blocks** (DB1, DB2, DB4, DB5, DB10) - Device-specific data
- **Position Data** (PP1) - Product positioning information
- **System Data** (SD1, G85, SE) - Configuration and session management

Over **50+ data block types** are fully supported with proper field mapping and documentation.

## Notes

- ✅ **Production Ready** - All major EVA DTS data block types are now supported
- ✅ **Comprehensive** - Handles data from multiple vending machine manufacturers
- ✅ **Extensible** - Easy to add support for new or proprietary data block types
- ✅ **Well Tested** - Tested with real-world EVA DTS files from various machines

## Contributing

Feel free to fork this repository and submit pull requests. Contributions are welcome!

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
