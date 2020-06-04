<?php

declare(strict_types=1);

namespace App\Tasks\Task07\Domain;

class Tree
{
    private int $id;
    private ?string $name;

    private ?Tree $parent;

    /** @var array<Tree> */
    private array $children = [];

    public function __construct(int $id, ?string $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }

    public function addChild(Tree $tree) : void
    {
        $tree->setParent($this);
        $this->children[] = $tree;
    }

    /**
     * @return array<Tree>
     */
    public function getChildren() : array
    {
        return $this->children;
    }

    public function getParent() : ?Tree
    {
        return $this->parent;
    }

    public function setParent(?Tree $parent) : void
    {
        $this->parent = $parent;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : ?string
    {
        return $this->name;
    }
}
