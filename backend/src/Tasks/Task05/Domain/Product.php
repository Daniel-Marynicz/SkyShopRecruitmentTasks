<?php

declare(strict_types=1);

namespace App\Tasks\Task05\Domain;

use function round;

class Product
{
    private string $name;
    private Price $grossPrice;
    private Vat $vat;

    public function __construct(string $name, Price $grossPrice, Vat $vat)
    {
        $this->name       = $name;
        $this->grossPrice = $grossPrice;
        $this->vat        = $vat;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getGrossPrice() : Price
    {
        return $this->grossPrice;
    }

    public function getNetPrice() : Price
    {
        $divisor = ($this->getVat()->value() + 100) /  100;

        return new Price(
            round($this->getGrossPrice()->value() / $divisor, 2)
        );
    }

    public function getVat() : Vat
    {
        return $this->vat;
    }
}
