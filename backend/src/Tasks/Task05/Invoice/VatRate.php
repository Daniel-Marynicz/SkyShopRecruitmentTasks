<?php

declare(strict_types=1);

namespace App\Tasks\Task05\Invoice;

use App\Tasks\Task05\Vat;

class VatRate
{
    private Vat $vat;
    private float $netTotal   = 0.0;
    private float $vatValue   = 0.0;
    private float $grossValue = 0.0;

    public function __construct(Vat $vat)
    {
        $this->vat = $vat;
    }

    /**
     * @return $this
     */
    public function add(float $netTotal, float $vatValue, float $grossValue)
    {
        $this->netTotal   += $netTotal;
        $this->vatValue   += $vatValue;
        $this->grossValue += $grossValue;

        return $this;
    }

    public function getVat() : Vat
    {
        return $this->vat;
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
