<?php

declare(strict_types=1);

namespace App\Tasks\Task04\Domain\Product;

use App\Tasks\Task04\Domain\Traits\Capacity;

class Bottle extends Product
{
    use Capacity;
}
