<?php

declare(strict_types=1);

namespace App\Tasks\Task04\Cache;

interface Cache
{
    /**
     * @return mixed
     */
    public function get(string $key);

    /**
     * @param mixed $value
     */
    public function set(string $key, $value) : void;
}
