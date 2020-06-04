<?php

declare(strict_types=1);

namespace App\Tasks\Task04\Domain\Traits;

use App\Tasks\Task04\Domain\Thread\Thread;

trait CommentThread
{
    private Thread $thread;

    public function getCommentThread() : Thread
    {
        return $this->thread;
    }
}
