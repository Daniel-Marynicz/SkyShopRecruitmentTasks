<?php

declare(strict_types=1);

namespace App\Tasks\Task04\Domain\Traits;

trait Color
{
    private ?string $color;

    public function getColor() : ?string
    {
        return $this->color;
    }

    public function setColor(?string $color) : self
    {
        $this->color = $color;

        return $this;
    }
}
