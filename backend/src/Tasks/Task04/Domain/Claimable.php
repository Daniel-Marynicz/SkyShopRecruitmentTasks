<?php

declare(strict_types=1);

namespace App\Tasks\Task04\Domain;

use App\Tasks\Task04\Domain\User\User;

interface Claimable
{
    public function getAssignedUser() : ?User;

    public function setAssignedUser(?User $user) : void;

    public function canBeClaimed() : bool;

    public function canBeUnClaimed() : bool;
}
