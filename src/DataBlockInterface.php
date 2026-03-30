<?php
namespace PeanutPay\PhpEvaDts;


interface DataBlockInterface
{
    public function parse(string $evaDtsLine);

    public function get(string $field, $default = null);

    public function set(string $field, $value): self;

    public function toArray(bool $onlyAssignedFields = false): array;

    public function getTableHeaders(bool $onlyAssignedFields = true): array;

    public function toTableRow(bool $onlyAssignedFields = true): array;

}
