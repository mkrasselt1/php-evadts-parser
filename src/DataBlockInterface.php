<?php
namespace PeanutPay\PhpEvaDts;


interface DataBlockInterface
{
    public function parse(string $evaDtsLine);

}