<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PeanutPay\PhpEvaDts\Parser;

$parser = new Parser();

// $parser->load("./rhevendors.eva_dts");
$parser->load(__DIR__ . "/2024-11-27-15-00-Batch 2 - 17 PPHQ.txt");
// $parser->load("./sielaff.eva_dts");
echo $parser->getReport();
