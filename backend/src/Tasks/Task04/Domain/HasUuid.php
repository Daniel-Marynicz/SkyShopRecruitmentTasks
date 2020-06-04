<?php

declare(strict_types=1);

namespace App\Tasks\Task04\Domain;

use Ramsey\Uuid\UuidInterface;

interface HasUuid
{
    public function getUuid() : UuidInterface;
}
