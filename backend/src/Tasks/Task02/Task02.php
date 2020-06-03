<?php

declare(strict_types=1);

namespace App\Tasks\Task02;

use UnexpectedValueException;
use function filter_var;
use const FILTER_SANITIZE_NUMBER_INT;

class Task02
{
    public static function sanitizeNumbers(string $value) : string
    {
        $result = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
        if ($result === false) {
            throw new UnexpectedValueException('string was expected');
        }

        return $result;
    }
}
