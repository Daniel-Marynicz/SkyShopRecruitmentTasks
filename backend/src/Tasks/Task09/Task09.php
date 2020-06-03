<?php

declare(strict_types=1);

namespace App\Tasks\Task09;

use JsonException;

class Task09
{
    /**
     * @param array<mixed> $value
     *
     * @throws JsonException
     */
    public static function arrayToObject(array $value) : object
    {
        return (object) $value;
    }
}
