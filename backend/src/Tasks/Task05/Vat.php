<?php

declare(strict_types=1);

namespace App\Tasks\Task05;

use App\Tasks\Task05\ValueObject\FloatValueObject;
use function sprintf;

class Vat extends FloatValueObject
{
    private string $representationValue;

    public function __construct(float $value, ?string $representationValue = null)
    {
        parent::__construct($value);
        if ($representationValue === null) {
            $representationValue = sprintf('%d%%', $value);
        }

        $this->representationValue = $representationValue;
    }

    public function __toString() : string
    {
        return $this->representationValue;
    }
}
