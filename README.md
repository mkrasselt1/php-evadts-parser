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

## Notes

- This project is currently a work in progress (WIP).
- The parser currently focuses on providing a readable format for most product and device details.

## Contributing

Feel free to fork this repository and submit pull requests. Contributions are welcome!

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
