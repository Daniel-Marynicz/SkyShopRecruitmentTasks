<?php

declare(strict_types=1);

namespace App\Tasks\Task06;

use UnexpectedValueException;
use function array_map;
use function array_shift;
use function explode;
use function is_array;

class Task06
{
    /**
     * @param string[] $flatTree
     *
     * @return array<mixed>
     */
    public static function generateTree(array $flatTree, string $delimiter) : array
    {
        $tree = [];
        foreach ($flatTree as $flatTreeValue) {
            $exploded = explode($delimiter, $flatTreeValue);
            if (! is_array($exploded)) {
                throw new UnexpectedValueException('Excepted array!');
            }

            $elements           = array_map('trim', $exploded);
            $currentElementName = array_shift($elements);
            $currentTree        = &$tree;
            self::updateTree($elements, $currentElementName, $currentTree);
        }

        return $tree;
    }

    /**
     * @param array<mixed> $elements
     * @param array<mixed> $currentTree
     */
    private static function updateTree(array &$elements, ?string $currentElementName, array &$currentTree) : void
    {
        while ($currentElementName) {
            if (! isset($currentTree[$currentElementName])) {
                $currentTree[$currentElementName] = [];
            }

            $currentTree        = &$currentTree[$currentElementName];
            $currentElementName = array_shift($elements);
        }
    }
}
