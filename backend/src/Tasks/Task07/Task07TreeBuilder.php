<?php

declare(strict_types=1);

namespace App\Tasks\Task07;

use App\Tasks\Task07\Domain\FlatTreeElement;
use App\Tasks\Task07\Domain\Tree;

class Task07TreeBuilder
{
    /** @var FlatTreeElement[] */
    private array $flatTreeElements = [];

    /**
     * @param FlatTreeElement[] $flatTreeElements
     */
    public function __construct(array $flatTreeElements)
    {
        $this->flatTreeElements = $flatTreeElements;
    }

    public function addFlatTreeElement(FlatTreeElement $element) : void
    {
        $this->flatTreeElements[] = $element;
    }

    public function generateTree(int $parentId = 0, ?string $name = null) : Tree
    {
        $tree = new Tree($parentId, $name);

        foreach ($this->flatTreeElements as $element) {
            if ($element->getParentId() !== $parentId) {
                continue;
            }

            $tree->addChild(
                $this->generateTree($element->getId(), $element->getName())
            );
        }

        return $tree;
    }
}
