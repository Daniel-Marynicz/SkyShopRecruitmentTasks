<?php

declare(strict_types=1);

namespace App\Tasks\Task05\Domain\ValueObject;

use Stringable;

abstract class FloatValueObject implements Stringable
{
    protected float $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function value() : float
    {
        return $this->value;
    }

    public function __toString() : string
    {
        return (string) $this->value();
    }
}
