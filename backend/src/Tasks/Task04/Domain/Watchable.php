<?php

declare(strict_types=1);

namespace App\Tasks\Task04\Domain;

use App\Tasks\Task04\Domain\User\User;
use Doctrine\Common\Collections\Collection;

interface Watchable
{
    /**
     * Collections of users watching workorder
     *
     * @return Collection|User[]
     */
    public function getWatchers() : Collection;

    /**
     * Add User to watchers list
     *
     * @return static
     */
    public function addWatcher(User $user);

    /**
     * remove User from watchers list
     *
     * @return static
     */
    public function removeWatcher(User $user);
}
