<?php

declare(strict_types=1);

namespace App\Tasks\Task05\Domain\Invoice;

class InvoiceTotal
{
    private float $netTotal   = 0.0;
    private float $vatValue   = 0.0;
    private float $grossValue = 0.0;

    public function addNetTotal(float $value) : void
    {
        $this->netTotal += $value;
    }

    public function addVatValue(float $value) : void
    {
        $this->vatValue += $value;
    }

    public function addGrossValue(float $value) : void
    {
        $this->grossValue += $value;
    }

    public function getNetTotal() : float
    {
        return $this->netTotal;
    }

    public function getVatValue() : float
    {
        return $this->vatValue;
    }

    public function getGrossValue() : float
    {
        return $this->grossValue;
    }
}
