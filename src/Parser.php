<?php

namespace PeanutPay\PhpEvaDts;

/**
 * EVA DTS (Electronic Vending Audit Data Transfer Standard) Parser
 * 
 * This class is responsible for parsing EVA DTS files from vending machines
 * and converting them into structured data blocks for analysis.
 * 
 * @package PeanutPay\PhpEvaDts
 * @author Michael Krasselt <michael@peanutpay.de>
 */
class Parser
{
    /**
     * Create a new Parser instance
     */
    public function __construct() {}

    /**
     * The parsed report containing all data blocks
     * @var Report|null
     */
    private $report = null;

    /**
     * Load and parse an EVA DTS file from disk
     * 
     * @param string $fileName Path to the EVA DTS file
     * @return bool True if parsing was successful, false otherwise
     * 
     * @example
     * ```php
     * $parser = new Parser();
     * if ($parser->load('/path/to/machine.eva_dts')) {
     *     $report = $parser->getReport();
     *     echo $report->generateSalesTableString();
     * }
     * ```
     */
    public function load(string $fileName = "")
    {
        $handle = fopen($fileName, "r");
        if ($handle) {
            $this->report = new Report();
            //if (($line = fgets($handle)) !== false) {
            while (($line = fgets($handle)) !== false) {
                $newDataBlock = DataBlock::create($line);
                if (!\is_null($newDataBlock)) {
                    $this->report->add($newDataBlock);
                }
            }
            fclose($handle);
            return true;
        }
        return false;
    }

    /**
     * Parse EVA DTS content from a string
     * 
     * @param string $fileContent The EVA DTS content as string
     * @return bool True if parsing was successful, false otherwise
     * 
     * @example
     * ```php
     * $content = file_get_contents('machine.eva_dts');
     * $parser = new Parser();
     * if ($parser->parse($content)) {
     *     $report = $parser->getReport();
     *     $salesData = $report->generateSalesTable();
     * }
     * ```
     */
    public function parse(string $fileContent = "")
    {
        $this->report = new Report();
        $lines = explode("\n", $fileContent);
        if (count($lines)) {
            foreach ($lines as $line) {
                $newDataBlock = DataBlock::create($line);
                if (!\is_null($newDataBlock)) {
                    $this->report->add($newDataBlock);
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Get the parsed report containing all data blocks
     * 
     * @return Report|null The report object or null if no data was parsed
     * 
     * @example
     * ```php
     * $parser = new Parser();
     * $parser->load('machine.eva_dts');
     * $report = $parser->getReport();
     * 
     * if ($report) {
     *     echo "Total products: " . count($report->generateSalesTable()['products']);
     * }
     * ```
     */
    public function getReport(): ?Report
    {
        return $this->report;
    }
}
