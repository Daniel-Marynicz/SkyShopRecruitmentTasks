<?php

declare(strict_types=1);

namespace App\Tasks\Task04\Domain\Issue;

use App\Tasks\Task04\Domain\Claimable;
use App\Tasks\Task04\Domain\Commentable;
use App\Tasks\Task04\Domain\HasUuid;
use App\Tasks\Task04\Domain\Thread\Thread;
use App\Tasks\Task04\Domain\Traits\CommentThread;
use App\Tasks\Task04\Domain\Traits\Uuid;
use App\Tasks\Task04\Domain\User\User;
use App\Tasks\Task04\Domain\Watchable;
use App\Tasks\Task04\Services\UuidProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

abstract class Issue implements
    Claimable,
    Watchable,
    HasUuid,
    Commentable
{
    use Uuid;
    use CommentThread;

    /** @var Collection&iterable<User> */
    private Collection $watchers;
    private ?User $assignedUser;

    public function __construct()
    {
        $this->watchers = new ArrayCollection();
        $this->uuid     = UuidProvider::generate();
        $this->thread   = new Thread();
    }

    public function getAssignedUser() : ?User
    {
        return $this->assignedUser;
    }

    public function setAssignedUser(?User $user) : void
    {
        $this->assignedUser = $user;
    }

    public function canBeClaimed() : bool
    {
        return $this->getAssignedUser() === null;
    }

    public function canBeUnClaimed() : bool
    {
        return $this->getAssignedUser() !== null;
    }

    /**
     * @return Collection<User>
     */
    public function getWatchers() : Collection
    {
        return $this->watchers;
    }

    public function addWatcher(User $user) : self
    {
        if (! $this->watchers->contains($user)) {
            $this->watchers[] = $user;
        }

        return $this;
    }

    public function removeWatcher(User $user) : self
    {
        if ($this->watchers->contains($user)) {
            $this->watchers->removeElement($user);
        }

        return $this;
    }
}
