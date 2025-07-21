<?php

namespace PeanutPay\PhpEvaDts;

/**
 * Simple console table formatter
 * 
 * This utility class provides an easy way to format tabular data
 * for console output with automatic column width calculation,
 * headers, and optional titles.
 * 
 * @package PeanutPay\PhpEvaDts
 * @author Michael Krasselt <michael@peanutpay.de>
 * 
 * @example
 * ```php
 * $table = new ConsoleTable();
 * $table->setHeaders(['Product', 'Sales', 'Revenue'])
 *       ->addRow(['Coffee', '150', '€150.00'])
 *       ->addRow(['Tea', '89', '€89.00']);
 * echo $table->render('Sales Report');
 * ```
 */
class ConsoleTable
{
    /** @var array Table headers */
    private $headers = [];
    
    /** @var array Table data rows */
    private $rows = [];
    
    /** @var array Calculated column widths */
    private $columnWidths = [];

    /**
     * Set the table headers
     * 
     * @param array $headers Array of header strings
     * @return ConsoleTable Returns self for method chaining
     * 
     * @example
     * ```php
     * $table->setHeaders(['Name', 'Age', 'City']);
     * ```
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
        $this->calculateColumnWidths();
        return $this;
    }

    /**
     * Add a single row to the table
     * 
     * @param array $row Array of cell values for the row
     * @return ConsoleTable Returns self for method chaining
     * 
     * @example
     * ```php
     * $table->addRow(['John Doe', '30', 'New York']);
     * ```
     */
    public function addRow(array $row)
    {
        $this->rows[] = $row;
        $this->calculateColumnWidths();
        return $this;
    }

    /**
     * Add multiple rows to the table
     * 
     * @param array $rows Array of row arrays
     * @return ConsoleTable Returns self for method chaining
     * 
     * @example
     * ```php
     * $table->addRows([
     *     ['John', '30', 'NYC'],
     *     ['Jane', '25', 'LA']
     * ]);
     * ```
     */
    public function addRows(array $rows)
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }
        return $this;
    }

    /**
     * Calculate optimal column widths based on content
     * 
     * Analyzes headers and all row data to determine the minimum
     * width needed for each column, with a minimum of 8 characters.
     * 
     * @return void
     */
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

    /**
     * Render the table as a formatted string
     * 
     * @param string $title Optional title to display above the table
     * @return string The formatted table as a string
     * 
     * @example
     * ```php
     * echo $table->render('User List');
     * // ==================
     * //     User List
     * // ==================
     * // | Name | Age | City |
     * // ------------------
     * // | John | 30  | NYC  |
     * ```
     */
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

    /**
     * Render a single table row
     * 
     * @param array $row The row data to render
     * @return string The formatted row string
     */
    private function renderRow(array $row)
    {
        $cells = [];
        foreach ($row as $index => $cell) {
            $width = $this->columnWidths[$index] ?? 8;
            $cells[] = str_pad((string)$cell, $width, ' ', STR_PAD_RIGHT);
        }
        return '| ' . implode(' | ', $cells) . " |\n";
    }

    /**
     * Convert the table to string (same as render with no title)
     * 
     * @return string The formatted table
     */
    public function __toString(): string
    {
        return $this->render();
    }
}
