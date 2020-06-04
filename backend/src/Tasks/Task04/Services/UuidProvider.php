<?php

declare(strict_types=1);

namespace App\Tasks\Task04\Services;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UuidProvider
{
    public static function generate() : UuidInterface
    {
        return Uuid::uuid4();
    }
}
