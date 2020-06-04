<?php

declare(strict_types=1);

namespace App\Tasks\Task05\Domain\Invoice;

use App\Tasks\Task05\Domain\Amount;
use App\Tasks\Task05\Domain\Product;

class InvoiceProduct
{
    private Product $product;
    private Amount $amount;

    public function __construct(Product $product, Amount $amount)
    {
        $this->product = $product;
        $this->amount  = $amount;
    }

    public function getProduct() : Product
    {
        return $this->product;
    }

    public function getAmount() : Amount
    {
        return $this->amount;
    }
}
