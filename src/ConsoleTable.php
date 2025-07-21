<?php

namespace PeanutPay\PhpEvaDts;

/**
 * Simple console table formatter
 */
class ConsoleTable
{
    private $headers = [];
    private $rows = [];
    private $columnWidths = [];

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
        $this->calculateColumnWidths();
        return $this;
    }

    public function addRow(array $row)
    {
        $this->rows[] = $row;
        $this->calculateColumnWidths();
        return $this;
    }

    public function addRows(array $rows)
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }
        return $this;
    }

    private function calculateColumnWidths()
    {
        // Initialize with header widths
        foreach ($this->headers as $index => $header) {
            $this->columnWidths[$index] = strlen((string)$header);
        }

        // Check row widths
        foreach ($this->rows as $row) {
            foreach ($row as $index => $cell) {
                $cellLength = strlen((string)$cell);
                if (!isset($this->columnWidths[$index]) || $cellLength > $this->columnWidths[$index]) {
                    $this->columnWidths[$index] = $cellLength;
                }
            }
        }

        // Set minimum width
        foreach ($this->columnWidths as $index => $width) {
            $this->columnWidths[$index] = max($width, 8);
        }
    }

    public function render($title = '')
    {
        $output = '';
        $totalWidth = array_sum($this->columnWidths) + (count($this->columnWidths) - 1) * 3 + 2;

        // Title
        if ($title) {
            $output .= str_repeat('=', $totalWidth) . "\n";
            $titlePadding = max(0, ($totalWidth - strlen($title)) / 2);
            $output .= str_repeat(' ', (int)$titlePadding) . $title . "\n";
            $output .= str_repeat('=', $totalWidth) . "\n";
        }

        // Headers
        if (!empty($this->headers)) {
            $output .= $this->renderRow($this->headers);
            $output .= str_repeat('-', $totalWidth) . "\n";
        }

        // Rows
        foreach ($this->rows as $row) {
            $output .= $this->renderRow($row);
        }

        return $output;
    }

    private function renderRow(array $row)
    {
        $cells = [];
        foreach ($row as $index => $cell) {
            $width = $this->columnWidths[$index] ?? 8;
            $cells[] = str_pad((string)$cell, $width, ' ', STR_PAD_RIGHT);
        }
        return '| ' . implode(' | ', $cells) . " |\n";
    }

    public function __toString()
    {
        return $this->render();
    }
}
