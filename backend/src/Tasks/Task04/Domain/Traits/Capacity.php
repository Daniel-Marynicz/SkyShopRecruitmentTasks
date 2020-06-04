<?php

declare(strict_types=1);

namespace App\Tasks\Task04\Domain\Traits;

trait Capacity
{
    private ?string $capacity;

    public function getCapacity() : ?string
    {
        return $this->capacity;
    }

    public function setCapacity(?string $capacity) : self
    {
        $this->capacity = $capacity;

        return $this;
    }
}
