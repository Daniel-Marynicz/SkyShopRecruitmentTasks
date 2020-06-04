<?php

declare(strict_types=1);

namespace App\Tasks\Task04\Cache;

class ArrayCache implements Cache
{
    /** @var array<mixed> */
    private array $cacheItems = [];

    /**
     * @return mixed|null
     */
    public function get(string $key)
    {
        return $this->cacheItems[$key] ?? null;
    }

    /**
     * @param mixed $value
     */
    public function set(string $key, $value) : void
    {
        $this->cacheItems[$key] = $value;
    }
}
