# PHP EvaDTS Parser

This project provides a parser for EvaDTS files, allowing you to extract and display product and device details in a human-readable format.

## Features

- Parses EvaDTS files.
- Outputs product and device details in a readable format.

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
