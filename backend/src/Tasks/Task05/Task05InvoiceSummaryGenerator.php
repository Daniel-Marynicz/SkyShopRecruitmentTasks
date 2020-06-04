<?php

declare(strict_types=1);

namespace App\Tasks\Task05;

use App\Tasks\Task05\Domain\Invoice\InvoiceProduct;
use App\Tasks\Task05\Domain\Invoice\InvoiceSummary;
use App\Tasks\Task05\Domain\Invoice\InvoiceTotal;
use App\Tasks\Task05\Domain\Vat;
use function round;

class Task05InvoiceSummaryGenerator
{
    /** @var InvoiceProduct[] */
    private array $products = [];

    public function addInvoiceProduct(InvoiceProduct $invoiceProduct) : void
    {
        $this->products[] = $invoiceProduct;
    }

    public function createSummary() : InvoiceSummary
    {
        $summary      = new InvoiceSummary();
        $invoiceTotal = new InvoiceTotal();

        foreach ($this->products as $product) {
            $this->addVat($summary, $product, $invoiceTotal);
        }

        $summary->sortVat();
        $invoiceTotalVat = new Vat(0, 'Total');
        $summary->addVat(
            $invoiceTotalVat,
            $invoiceTotal->getNetTotal(),
            $invoiceTotal->getVatValue(),
            $invoiceTotal->getGrossValue()
        );

        return $summary;
    }

    private function addVat(InvoiceSummary $summary, InvoiceProduct $product, InvoiceTotal $invoiceTotal) : void
    {
        $vat      = $product->getProduct()->getVat();
        $netTotal = $product->getProduct()->getNetPrice()->value() * $product->getAmount()->value();

        $vatValue   = round($netTotal * $vat->value() / 100, 2);
        $grossValue = $netTotal + $vatValue;
        $invoiceTotal->addNetTotal($netTotal);
        $invoiceTotal->addVatValue($vatValue);
        $invoiceTotal->addGrossValue($grossValue);
        $summary->addVat($vat, $netTotal, $vatValue, $grossValue);
    }
}
