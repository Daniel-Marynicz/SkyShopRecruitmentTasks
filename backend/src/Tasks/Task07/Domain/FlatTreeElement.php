<?php

declare(strict_types=1);

namespace App\Tasks\Task07\Domain;

class FlatTreeElement
{
    private int $id;
    private int $parentId;
    private string $name;

    public function __construct(int $id, int $parentId, string $name)
    {
        $this->id       = $id;
        $this->parentId = $parentId;
        $this->name     = $name;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getParentId() : int
    {
        return $this->parentId;
    }

    public function getName() : string
    {
        return $this->name;
    }
}
