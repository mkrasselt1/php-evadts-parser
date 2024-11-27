<?php

namespace PeanutPay\PhpEvaDts;

class Parser
{
    public function __construct()
    {
    }

    private $report = null;

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

    public function getReport(): ?Report
    {
        return $this->report;
    }
}
