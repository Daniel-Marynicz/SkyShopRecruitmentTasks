<?php

declare(strict_types=1);

namespace App\Tasks\Task04\Domain\Thread;

use App\Tasks\Task04\Domain\HasUuid;
use App\Tasks\Task04\Domain\Traits\Uuid;
use App\Tasks\Task04\Services\UuidProvider;

class Thread implements HasUuid
{
    use Uuid;

    public function __construct()
    {
        $this->uuid = UuidProvider::generate();
    }
}
