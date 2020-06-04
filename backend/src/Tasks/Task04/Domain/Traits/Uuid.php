<?php

declare(strict_types=1);

namespace App\Tasks\Task04\Domain\Traits;

use Ramsey\Uuid\UuidInterface;

trait Uuid
{
    private UuidInterface $uuid;

    public function getUuid() : UuidInterface
    {
        return $this->uuid;
    }
}
