<?php

declare(strict_types=1);

namespace App\Tasks\Task04\Domain;

use App\Tasks\Task04\Domain\Thread\Thread;

interface Commentable
{
    public function getCommentThread() : Thread;
}
