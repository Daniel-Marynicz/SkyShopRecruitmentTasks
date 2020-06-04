<?php

declare(strict_types=1);

namespace App\Tasks\Task04\Domain\User;

use App\Tasks\Task04\Domain\HasUuid;
use App\Tasks\Task04\Domain\Traits\Uuid;
use App\Tasks\Task04\Services\UuidProvider;

class User implements HasUuid
{
    use Uuid;

    private string $username;
    private string $email;

    public function __construct()
    {
        $this->uuid = UuidProvider::generate();
    }

    public function getUsername() : string
    {
        return $this->username;
    }

    public function setUsername(string $username) : User
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function setEmail(string $email) : User
    {
        $this->email = $email;

        return $this;
    }
}
