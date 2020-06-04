<?php

declare(strict_types=1);

namespace App\Tasks\Task04\Domain\Product;

use App\Tasks\Task04\Domain\Commentable;
use App\Tasks\Task04\Domain\HasUuid;
use App\Tasks\Task04\Domain\Traits\CommentThread;
use App\Tasks\Task04\Domain\Traits\Uuid;

abstract class Product implements HasUuid, Commentable
{
    use Uuid;
    use CommentThread;

    private string $name;
    private float $netPrice;
    private float $vat;

    private string $description;

    public function __construct(string $name, float $netPrice, float $vat, string $description)
    {
        $this->name        = $name;
        $this->netPrice    = $netPrice;
        $this->vat         = $vat;
        $this->description = $description;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name) : Product
    {
        $this->name = $name;

        return $this;
    }

    public function getNetPrice() : float
    {
        return $this->netPrice;
    }

    public function setNetPrice(float $netPrice) : Product
    {
        $this->netPrice = $netPrice;

        return $this;
    }

    public function getVat() : float
    {
        return $this->vat;
    }

    public function setVat(float $vat) : Product
    {
        $this->vat = $vat;

        return $this;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $description) : Product
    {
        $this->description = $description;

        return $this;
    }
}
