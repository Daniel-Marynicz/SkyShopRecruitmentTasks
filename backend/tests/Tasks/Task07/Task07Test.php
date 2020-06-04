<?php

declare(strict_types=1);

namespace App\Tests\Tasks\Task07;

use App\Tasks\Task07\Domain\FlatTreeElement;
use App\Tasks\Task07\Domain\Tree;
use App\Tasks\Task07\Task07TreeBuilder;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;

class Task07Test extends TestCase
{
    /**
     * @param FlatTreeElement[] $flatTree
     *
     * @dataProvider generateTreeProvider
     */
    public function testGenerateTree(array $flatTree, Tree $expectedTree) : void
    {
        $treeBuilder = new Task07TreeBuilder($flatTree);
        $actualTree  = $treeBuilder->generateTree();
        $this->assertEquals($expectedTree, $actualTree);
    }

    /**
     * @return array<mixed>
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function generateTreeProvider() : array
    {
        return [
            [
                [
                    new FlatTreeElement(1, 0, 'Elektronika'),
                    new FlatTreeElement(2, 6, 'test'),
                    new FlatTreeElement(3, 1, 'Roboty'),
                    new FlatTreeElement(4, 6, 'Piłka nożna'),
                    new FlatTreeElement(5, 0, 'Turystyka'),
                    new FlatTreeElement(6, 0, 'Sport'),
                    new FlatTreeElement(7, 1, 'Telefony'),
                    new FlatTreeElement(8, 1, 'Laptopy'),
                    new FlatTreeElement(9, 1, 'Tablety'),
                    new FlatTreeElement(10, 6, 'Siłownia i fitness'),
                ],
                $this->createTree(
                    0,
                    null,
                    [
                        $this->createTree(
                            1,
                            'Elektronika',
                            [
                                $this->createTree(
                                    3,
                                    'Roboty',
                                    []
                                ),
                                $this->createTree(
                                    7,
                                    'Telefony',
                                    []
                                ),
                                $this->createTree(
                                    8,
                                    'Laptopy',
                                    []
                                ),
                                $this->createTree(
                                    9,
                                    'Tablety',
                                    []
                                ),
                            ]
                        ),
                        $this->createTree(
                            5,
                            'Turystyka',
                            []
                        ),
                        $this->createTree(
                            6,
                            'Sport',
                            [
                                $this->createTree(
                                    2,
                                    'test',
                                    []
                                ),
                                $this->createTree(
                                    4,
                                    'Piłka nożna',
                                    []
                                ),
                                $this->createTree(
                                    10,
                                    'Siłownia i fitness',
                                    []
                                ),
                            ]
                        ),
                    ]
                ),
            ],
        ];
    }

    /**
     * @param Tree[] $children
     *
     * @throws ReflectionException
     */
    public function createTree(int $id, ?string $name, array $children = []) : Tree
    {
        $treeRef = new ReflectionClass(Tree::class);
        $tree    = $treeRef->newInstanceWithoutConstructor();
        $this->setPropertyValue($tree, 'id', $id);
        $this->setPropertyValue($tree, 'name', $name);
        $this->setPropertyValue($tree, 'children', $children);
        foreach ($children as $child) {
            $this->setPropertyValue($child, 'parent', $tree);
        }

        return $tree;
    }

    /**
     * @param mixed $value
     *
     * @throws ReflectionException
     */
    private function setPropertyValue(object $object, string $name, $value) : void
    {
        $ref         = new ReflectionClass($object);
        $refProperty = $ref->getProperty($name);
        $refProperty->setAccessible(true);
        $refProperty->setValue($object, $value);
    }
}
