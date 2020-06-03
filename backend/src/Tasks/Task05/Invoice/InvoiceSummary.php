<?php

declare(strict_types=1);

namespace App\Tasks\Task05\Invoice;

use App\Tasks\Task05\Vat;
use function usort;

class InvoiceSummary
{
    /** @var VatRate[] */
    private array $vatRates = [];

    public function addVat(Vat $vat, float $netTotal, float $vatValue, float $grossValue) : void
    {
        $rate = $this->getVatRate($vat);
        if ($rate === null) {
            $rate             = new VatRate($vat);
            $this->vatRates[] = $rate;
        }

        $rate->add($netTotal, $vatValue, $grossValue);
    }

    public function sortVat() : void
    {
        usort($this->vatRates, static function (VatRate $rateA, VatRate $rateB) {
            $valueA = $rateA->getVat()->value();
            $valueB = $rateB->getVat()->value();
            if ($valueA === $valueB) {
                return 0;
            }

            return $valueA > $valueB ? -1 : 1;
        });
    }

    /**
     * @return VatRate[]
     */
    public function getVatRates() : array
    {
        return $this->vatRates;
    }

    private function getVatRate(Vat $vat) : ?VatRate
    {
        foreach ($this->vatRates as $rate) {
            if ((string) $rate->getVat() === (string) $vat) {
                return $rate;
            }
        }

        return null;
    }
}
