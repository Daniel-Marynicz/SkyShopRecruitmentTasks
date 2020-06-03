<?php

declare(strict_types=1);

namespace App\Tasks\Task05\Invoice;

use App\Tasks\Task05\Vat;
use function round;

class Invoice
{
    /** @var InvoiceProduct[] */
    private array $products = [];

    public function addInvoiceProduct(InvoiceProduct $invoiceProduct) : void
    {
        $this->products[] = $invoiceProduct;
    }

    public function createSummary() : InvoiceSummary
    {
        $summary           = new InvoiceSummary();
        $invoiceNetTotal   = 0.0;
        $invoiceVatValue   = 0.0;
        $invoiceGrossValue = 0.0;

        foreach ($this->products as $product) {
            $vat      = $product->getProduct()->getVat();
            $netTotal = $product->getProduct()->getNetPrice()->value() * $product->getAmount()->value();

            $vatValue           = round($netTotal * $vat->value() / 100, 2);
            $grossValue         = $netTotal + $vatValue;
            $invoiceNetTotal   += $netTotal;
            $invoiceVatValue   += $vatValue;
            $invoiceGrossValue += $grossValue;
            $summary->addVat($vat, $netTotal, $vatValue, $grossValue);
        }

        $summary->sortVat();
        $invoiceTotalVat = new Vat(0, 'Total');
        $summary->addVat($invoiceTotalVat, $invoiceNetTotal, $invoiceVatValue, $invoiceGrossValue);

        return $summary;
    }
}
