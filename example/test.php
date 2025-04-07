<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

$parser = new Parser();

if (isset($argv[1])) {
    if (is_file($argv[1])) {
        $parser->load($argv[1]);
        // $parser->parse(file_get_contents($argv[1]));
        echo $parser->getReport();
    } else {
        echo "file not found: " . $argv[1] . "\r\n";
    }
} else {
    echo "missing filename parameter";
}
