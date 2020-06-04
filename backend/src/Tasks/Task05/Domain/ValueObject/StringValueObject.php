<?php

declare(strict_types=1);

namespace App\Tasks\Task05\Domain\ValueObject;

use Stringable;

abstract class StringValueObject implements Stringable
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value() : string
    {
        return $this->value;
    }

    public function __toString() : string
    {
        return $this->value();
    }
}
