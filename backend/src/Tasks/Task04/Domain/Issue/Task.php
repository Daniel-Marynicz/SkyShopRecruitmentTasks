<?php

declare(strict_types=1);

namespace App\Tasks\Task04\Domain\Issue;

class Task extends Issue
{
    /** @var Subtask[] */
    private array $subtasks = [];

    /**
     * @return Subtask[]
     */
    public function getSubtasks() : array
    {
        return $this->subtasks;
    }

    /**
     * @param Subtask[] $subtasks
     */
    public function setSubtasks(array $subtasks) : Task
    {
        $this->subtasks = $subtasks;

        return $this;
    }
}
