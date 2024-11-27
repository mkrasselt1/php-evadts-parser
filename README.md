!!! WIP !!!
For now this just outputs a human readable format of most of the product and device details

<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

$parser = new Parser();

// $parser->load(__DIR__ . "/rhevendors.eva_dts");
echo $parser->getReport();
